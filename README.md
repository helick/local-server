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
Creating network "docker_default" with the default driver
Creating volume "docker_mysql-data" with default driver
Creating volume "docker_elasticsearch-data" with default driver
Creating helick-skeleton-mysql         ... done
Creating helick-skeleton-elasticsearch ... done
Creating helick-skeleton-proxy         ... done
Creating helick-skeleton-php           ... done
Creating helick-skeleton-phpmyadmin    ... done
Creating helick-skeleton-nginx         ... done
Started.

To access site please visit: http://helick-skeleton.localtest.me/
To access phpmyadmin please visit: http://phpmyadmin.helick-skeleton.localtest.me/
To access elasticsearch please visit: http://elasticsearch.helick-skeleton.localtest.me/
```

### Stopping the local server

To stop the local server, simply run `composer local-server stop`.

### Destroying the local server

To destroy the local server, simply run `composer local-server destroy`.

### Viewing the local server status

To get details on the running local server status, run `composer local-server status`. You should see output similar to:

``` sh
            Name                           Command                  State                         Ports
--------------------------------------------------------------------------------------------------------------------------
helick-skeleton-elasticsearch   /usr/local/bin/docker-entr ...   Up (healthy)   9200/tcp, 9300/tcp
helick-skeleton-mysql           docker-entrypoint.sh --def ...   Up (healthy)   3306/tcp, 33060/tcp
helick-skeleton-nginx           nginx -g daemon off;             Up             80/tcp
helick-skeleton-php             docker-php-entrypoint php-fpm    Up             9000/tcp
helick-skeleton-phpmyadmin      /run.sh supervisord -n -j  ...   Up             80/tcp, 9000/tcp
helick-skeleton-proxy           /traefik                         Up             0.0.0.0:80->80/tcp, 0.0.0.0:8080->8080/tcp
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
