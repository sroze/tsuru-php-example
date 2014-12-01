# Flynn PHP application example

This application show how to setup, deploy, run & update a PHP application on a [Flynn](https://flynn.io/) cluster.

## Getting started

Clone the repository and create the Flynn application:
```
git clone https://github.com/sroze/flynn-php-example.git
flynn create php-example
```

Add the PostgreSQL database resource:
```
flynn resource add postgres
```

Deploy your application:
```
git push flynn master
```

## Notes

This application is only an example application that can be deployed to a Flynn cluster. You first need to [setup a cluster](https://flynn.io/docs/installation).
It is using the PHP [discoverd-client library](https://github.com/sroze/discoverd-client) that allow to get the PostgreSQL service address.
