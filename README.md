# Apex chart integration with filament with extra batteries and an elegent api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hasnayeen/glow-chart.svg?style=flat-square)](https://packagist.org/packages/hasnayeen/glow-chart)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hasnayeen/glow-chart/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hasnayeen/glow-chart/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hasnayeen/glow-chart/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hasnayeen/glow-chart/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hasnayeen/glow-chart.svg?style=flat-square)](https://packagist.org/packages/hasnayeen/glow-chart)



This plugin integrates [Apex Charts](https://apexcharts.com/) on Filament to provide beautiful and interactive visualizations for your data.

## Installation

You can install the package via composer:

```bash
composer require hasnayeen/glow-chart
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="glow-chart-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="glow-chart-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$glowChart = new Hasnayeen\GlowChart();
echo $glowChart->echoPhrase('Hello, Hasnayeen!');
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

- [Hasnayeen](https://github.com/Hasnayeen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
