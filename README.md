# Tsuru PHP application example

This application show how to setup, deploy, run & update a PHP application on a [Tsuru](https://tsuru.io/) cluster.

## Getting started

Clone the repository and create the Flynn application:
```
git clone https://github.com/sroze/tsuru-php-example.git
tsuru app-create php-example
```

Add the PostgreSQL database resource:
```

```

Set the custom build pack (from Heroku):
```
tsuru env-set BUILDPACK_URL=https://github.com/heroku/heroku-buildpack-php
```

Deploy your application:
```
git push flynn master
```
