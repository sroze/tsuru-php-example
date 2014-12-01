<?php
namespace App\Controller;

use Doctrine\DBAL\Connection;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class StatusController implements ControllerProviderInterface
{
    /**
     * Note: please do not use such code for real development. Mixing view, model & controller is... to
     * never do (except for quick PaaS usage examples :)) !!
     *
     * @param Application $app
     * @return \Silex\ControllerCollection
     */
    public function connect(Application $app)
    {
        /** @var $controllers */
        $controllers = $app['controllers_factory'];
        $controllers->get('/', function (Application $app) {
            $output = '';
            $status = 200;

            try {
                /** @var Connection $database */
                $database = $app['db'];
                $database->executeQuery('CREATE TABLE IF NOT EXISTS hits (hitTime TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(), ip VARCHAR NOT NULL)');

                $database->insert('hits', array(
                    'ip' => $_SERVER['HTTP_X_FORWARDED_FOR']
                ));

                $result = $database->fetchAssoc('SELECT COUNT(*) as number FROM hits');
                $output .= '<h1>'.$result['number'].' hits !</h1>';

                $lastHits = $database->fetchAll('SELECT * FROM hits ORDER BY hits.hitTime DESC LIMIT 10');
                $output .= '<h2>Last 10 hits</h2>';
                $output .= '<table><thead><tr><th>Datetime</th><th>IP</th></tr></thead><tbody>';
                foreach($lastHits as $hit) {
                    $output .= '<tr><td>'.$hit['hittime'].'</td><td>'.$hit['ip'].'</td></tr>';
                }

                $output .= '</tbody></table>';

            } catch (\Exception $e) {
                $output .= '<p>[EXCEPTION] '.$e->getMessage().'</p>';
                $output .= '<pre>'.$e->getTraceAsString().'</pre>';

                $status = 500;
            }

            return new Response($output, $status);
        });

        return $controllers;
    }
}