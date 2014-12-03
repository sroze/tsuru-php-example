# Tsuru PHP application example

This application show how to setup, deploy, run & update a PHP application on a [Tsuru](https://tsuru.io/) cluster.

## Getting started

Clone the repository and create the Tsuru application:
```
git clone https://github.com/sroze/tsuru-php-example.git
tsuru app-create php-example php
```

Using `app-info`, add the Git remote named `tsuru` and run deploy your application:
```
git push tsuru master
```

Create a PostgreSQL instance by the way you want. This is an example with [postgresapi](https://github.com/guokr/tsuru-postgresapi) and a shared instance:
```
tsuru service-add postgresapi example-db
```

Here's an example for a dedicated instance:
```
tsuru service-add postgresapi example-db dedicated
```

Bind the PostgreSQL database resource:
```
tsuru service-bind example-db
```

## Scale

You can also scale your application by adding units (here it'll add 2 more units):
```
tsuru unit-add 2
```
