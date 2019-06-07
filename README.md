# Helick Local Server

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Quality Score][ico-code-quality]][link-code-quality]

The local server package providers a local development environment for Helick projects. It is built on a containerized architecture using Docker images and Docker Compose to provide drop-in replacements for most components of the Cloud infrastructure.

## Requirements

Make sure all dependencies have been installed before moving on:

* [PHP](http://php.net/manual/en/install.php) >= 7.1
* [Composer](https://getcomposer.org/download/)
* [Docker Desktop](https://www.docker.com/products/docker-desktop)

## Install

Via Composer:

``` bash
$ composer require helick/local-server --dev
```

## Usage

### Starting the local server

To start the local server, simply run `composer local-server start`. The first time you this will download all the necessary Docker images.

Once the initial install and download have completed, you should see the output:

``` sh
Starting...

Started.
To access your site visit: http://helick.localtest.me/
To access phpmyadmin please visit: http://phpmyadmin.helick.localtest.me/
To access elasticsearch please visit: http://elasticsearch.helick.localtest.me/
```

### Stopping the local server

To stop the local server, simply run `composer local-server stop`.

### Destroying the local server

To destroy the local server, simply run `composer local-server destroy`.

### Viewing the local server status

To get details on the running local server status, run `composer local-server status`. You should see output similar to:

```sh
         Name                       Command                  State              Ports
--------------------------------------------------------------------------------------------
docker_mysql_1           docker-entrypoint.sh --def ...   Up (healthy)   3306/tcp, 33060/tcp
docker_nginx_1           nginx -g daemon off;             Up             80/tcp
docker_php_1             docker-php-entrypoint php-fpm    Up             9000/tcp
docker_redis_1           docker-entrypoint.sh redis ...   Up (healthy)   6379/tcp
```

All containers should have a status of "Up". If they do not, you can inspect the logs for each service by running `composer local-server logs <service>`, for example, if `docker_mysql_1` shows a status other than "Up", run `composer local-server logs mysql`.

### Viewing the local server logs

Often you'll want to access logs from the services that local server provides. For example, PHP errors logs, Nginx access logs, or MySQL logs. To do so, run the `composer local-server logs <service>` command, where `<service>` can be any of `php`, `nginx`, `mysql`, `elasticsearch`. This command will tail the logs (live update). To exit the log view, simply press `Ctrl+C`.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email evgenii@helick.io instead of using the issue tracker.

## Credits

- [Evgenii Nasyrov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/helick/local-server.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/helick/local-server.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/helick/local-server.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/helick/local-server
[link-code-quality]: https://scrutinizer-ci.com/g/helick/local-server
[link-downloads]: https://packagist.org/packages/helick/local-server
[link-author]: https://github.com/nasyrov
[link-contributors]: ../../contributors
