# Bearer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/bearer.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/bearer)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/bearer/run-tests?label=tests)](https://github.com/ryangjchandler/bearer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/bearer/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ryangjchandler/bearer/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/bearer.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/bearer)

Minimalistic token-based authentication for Laravel API endpoints.

## Installation

You can install the package via Composer:

```bash
composer require ryangjchandler/bearer
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="RyanChandler\Bearer\BearerServiceProvider" --tag="bearer-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="RyanChandler\Bearer\BearerServiceProvider" --tag="bearer-config"
```

## Usage

```php
$bearer = new Ryangjchandler\Bearer();
echo $bearer->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
