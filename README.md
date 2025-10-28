# Laravel Mastercard Gateway

[![Latest Version on Packagist](https://img.shields.io/packagist/v/souidev/mastercard-gateway.svg?style=flat-square)](https://packagist.org/packages/souidev/mastercard-gateway)
[![Total Downloads](https://img.shields.io/packagist/dt/souidev/mastercard-gateway.svg?style=flat-square)](https://packagist.org/packages/souidev/mastercard-gateway)

This package provides a simple and expressive interface for interacting with the Mastercard Gateway REST API in Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require souidev/mastercard-gateway
```

## Configuration

Publish the configuration file using the following command:

```bash
php artisan vendor:publish --provider="Souidev\MastercardGateway\MastercardGatewayServiceProvider"
```

This will create a `config/mastercard-gateway.php` file in your application. You should then configure your Mastercard Gateway credentials in your `.env` file:

```
MASTERCARD_GATEWAY_URL=https://test-tnpost.mtf.gateway.mastercard.com/api/rest
MASTERCARD_MERCHANT_ID=YOUR_MERCHANT_ID
MASTERCARD_API_USERNAME=merchant.YOUR_MERCHANT_ID
MASTERCARD_PASSWORD=YOUR_API_PASSWORD
MASTERCARD_VERSION=100
```

## Usage

You can interact with the gateway using the `MastercardGateway` facade.

### Making a Payment

```php
use Souidev\MastercardGateway\Facades\MastercardGateway;

$response = MastercardGateway::charge([
    'orderId' => '12345',
    'transaction' => [
        'amount' => 100.00,
        'currency' => 'USD',
    ],
    // ... other transaction details
]);

if ($response->isSuccessful()) {
    // Handle successful payment
    $order = $response->order;
} else {
    // Handle failed payment
}
```

### Updating a Transaction

```php
use Souidev\MastercardGateway\Facades\MastercardGateway;

$response = MastercardGateway::updateTransaction('12345', 'TXN123', [
    'transaction' => [
        'amount' => 150.00,
        'currency' => 'USD',
    ],
]);

if ($response->isSuccessful()) {
    // Handle successful update
}
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

- [Your Name](https://github.com/your-github-username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
