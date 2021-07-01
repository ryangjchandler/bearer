# Bearer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/bearer.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/bearer)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/bearer/run-tests?label=tests)](https://github.com/ryangjchandler/bearer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/bearer/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ryangjchandler/bearer/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/bearer.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/bearer)

Minimalistic token-based authorization for Laravel API endpoints.

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

### Creating tokens

To create a new token, you can use the `RyanChandler\Bearer\Models\Token` model.

```php
use RyanChandler\Bearer\Models\Token;

$token = Token::create([
    'token' => Str::random(32),
]);
```

Alternatively, you can use the `RyanChandler\Bearer\Facades\Bearer` facade to `generate` a token.

```php
use RyanChandler\Bearer\Facades\Bearer;

$token = Bearer::generate(domains: [], expiresAt: null);
```

By default, Bearer uses time-ordered UUIDs for token strings. You can modify this behaviour by passing a `Closure` to `Bearer::generateTokenUsing`. This function must return a string for storage to the database.

```php
use RyanChandler\Bearer\Facades\Bearer;

Bearer::generateTokenUsing(static function (): string {
    return (string) Str::orderedUuid();
});
```

### Retrieving a `Token` instance

To retreive a `Token` instance from the `token` string, you can use the `RyanChandler\Bearer\Facades\Bearer` facade.

```php
use RyanChandler\Bearer\Facades\Bearer;

$token = Bearer::find('my-token-string');
```

### Using a token in a request

Bearer uses the `Authorization` header of a request to retreive the token instance. You should format it like so:

```
Authorization: Bearer my-token-string
```

### Verifying tokens

To verify a token, add the `RyanChandler\Bearer\Http\Middleware\VerifyBearerToken` middleware to your API route.

```php
use RyanChandler\Bearer\Http\Middleware\VerifyBearerToken;

Route::get('/endpoint', MyEndpointController::class)->middleware(VerifyBearerToken::class);
```

### Token expiration

If you would like a token to expire at a particular time, you can use the `expires_at` column.

```php
$token = Bearer::find('my-token-string');

$token->update([
    'expires_at' => now()->addWeek(),
]);
```

Or just use the class's helper methods.

```php
$token = Bearer::find('my-token-string');

$token->addWeeks(1)->save();
```

If you try to use the token after this time, it will return an error.

### Limit tokens to a particular domain

Token usage can be restricted to a particular domain. Bearer uses the scheme and host from the request to determine if the token is valid or not.

```php
$token = Bearer::find('my-token-string');

$token->update([
    'domains' => [
        'https://laravel.com',
    ],
]);
```

If you attempt to use this token from any domain other than `https://laravel.com`, it will fail and abort.

> **Note**: domain checks include the scheme so be sure to add both cases for HTTP and HTTPS if needed.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
