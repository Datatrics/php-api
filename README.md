![Datatrics](https://www.datatrics.com/wp-content/themes/datatrics/assets/img/logo/logo.png)

[![Latest Stable Version](https://img.shields.io/packagist/v/datatrics/php-api.svg)](https://packagist.org/packages/datatrics/php-api)
[![Latest Unstable Version](http://img.shields.io/packagist/vpre/datatrics/php-api.svg)](https://packagist.org/packages/datatrics/php-api)
[![Travis branch](https://img.shields.io/travis/Datatrics/php-api/2.0.svg)](https://travis-ci.org/Datatrics/php-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Datatrics/php-api/badges/quality-score.png?b=2.0)](https://scrutinizer-ci.com/g/Datatrics/php-api/?branch=2.0)
[![Code Coverage](https://scrutinizer-ci.com/g/Datatrics/php-api/badges/coverage.png?b=2.0)](https://scrutinizer-ci.com/g/Datatrics/php-api/?branch=2.0)
[![Code Climate](https://img.shields.io/codeclimate/github/datatrics/php-api.svg)](https://codeclimate.com/repos/58fc98489c3fbc02860009e3)
![License](http://img.shields.io/badge/license-MIT-green.svg)

# Datatrics PHP API client
This package is a convenience wrapper to communicate with the Datatrics REST-API

## Installation
For the installation of the client, there are 2 ways. The composer way is preferable, but not always possible.

### Composer
Include the package in your `composer.json` file
``` json
{
    "require": {
        "datatrics/php-api": "2.0.x-dev"
    }
}
```

...then run `composer update` and load the composer autoloader:

``` php
<?php
require 'vendor/autoload.php';

// ...
```

### Manual
Obtain the latest version of the Datatrics PHP API client
``` bash
git clone https://github.com/Datatrics/php-api
```

And include the class in your project
``` php
require_once '/path/to/Client.php';
```

## Usage
There are a lot of API resources that are accessible through this client. You can look them up by looking at the code. Their name matches the name in the documentation.

``` php
<?php
require 'vendor/autoload.php';

$client = new Client('[api-key]', '[project-id]');

$project = $client->Project->Get('[project-id]');
```

__Explanation__

[api-key]
The API key you've received or created

[project-id]
id of the project

## Contributing
We love contributions, but please note that the API client is generated. If you have suggested changes, you may still create a PR, but your PR will not be merged. We will however adapt the generator to reflect your changes. You can also create a GitHub issue if there's something you miss.
