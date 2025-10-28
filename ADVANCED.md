# Advanced Configuration

This guide covers advanced configuration options for the Laravel Mastercard Gateway package.

## Proxy Configuration

If you need to route API requests through a proxy server, you can configure the proxy settings in your `config/mastercard-gateway.php` file or directly in your `.env` file.

```php
// config/mastercard-gateway.php
'proxy' => [
    'server' => env('MASTERCARD_PROXY_SERVER'),
    'auth' => env('MASTERCARD_PROXY_AUTH'),
],
```

Add the following to your `.env` file:

```
MASTERCARD_PROXY_SERVER=tcp://hostname:port
MASTERCARD_PROXY_AUTH=username:password
```

## SSL Certificate Verification

For enhanced security, you can configure the package to use a custom SSL certificate bundle for verifying the peer.

### Certificate Path

Set the path to your certificate file (`.pem` format) in the configuration.

```php
// config/mastercard-gateway.php
'certificate' => [
    'path' => env('MASTERCARD_CERTIFICATE_PATH'),
    'verify_peer' => env('MASTERCARD_VERIFY_PEER', true),
    'verify_host' => env('MASTERCARD_VERIFY_HOST', 2),
],
```

Add the path to your `.env` file:

```
MASTERCARD_CERTIFICATE_PATH=/path/to/your/cacert.pem
```

### Disabling Verification (Not Recommended)

In development environments, you may need to disable SSL verification. **This is not recommended for production.**

```
MASTERCARD_VERIFY_PEER=false
MASTERCARD_VERIFY_HOST=0
```

## Debugging

You can enable debug mode to get more detailed output from the Guzzle HTTP client, which can be useful for troubleshooting connection issues.

Set the following in your `.env` file:

```
MASTERCARD_DEBUG=true
```

This will log the full request and response details.
