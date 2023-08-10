# Apex chart integration for filament with extra batteries and Filament like api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hasnayeen/glow-chart.svg?style=flat-square)](https://packagist.org/packages/hasnayeen/glow-chart)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hasnayeen/glow-chart/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hasnayeen/glow-chart/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hasnayeen/glow-chart/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hasnayeen/glow-chart/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hasnayeen/glow-chart.svg?style=flat-square)](https://packagist.org/packages/hasnayeen/glow-chart)



This plugin integrates [Apex Charts](https://apexcharts.com/) on Filament to provide beautiful and interactive visualizations for your data.

## Installation

You can install the package via composer:

```bash
composer require hasnayeen/glow-chart:^3.0
```

## Usage

Create a new chart widget with following command:

```sh
php artisan make:glow-chart BlogPostsChart
```

The above command will create following class

```php
<?php

namespace App\Filament\Widgets;

use Hasnayeen\GlowChart\Glowchart;
use Hasnayeen\GlowChart\Chart;
use Hasnayeen\GlowChart\Enums\ChartType;
use Hasnayeen\GlowChart\Options;
use Hasnayeen\GlowChart\Series;

class BlogPostsChart extends GlowChart
{
    protected static string $id = 'BlogPostsChart';

    protected static ?string $heading = 'Chart';

    protected function getOptions(): Options
    {
        return Options::make()
            ->chart(
                Chart::make(ChartType::Line)
            )
            ->series(
                Series::make()
                    ->data([])
            );
    }
}
```

The `protected static ?string $id` variable is used for referencing element to insert the Apex chart. You can override it but it should be unique from other chart on the page.

The `protected static ?string $heading` variable is used to set the heading that describes the chart.

The `getOptions` method is used to set [Apex Charts Options](https://apexcharts.com/docs/options). The method should return an `Hasnayeen\GlowChart\Options` object. You can set all the options for available for Apex chart by using flent methods on `Options` object.

First, you must set chart options via `chart` method:

```php
    protected function getOptions(): Options
    {
        return Options::make('BlogPostsChart')
            ->chart(
                Chart::make(ChartType::Area)
                    ->height(300)
                    ->toolbar(
                        Toolbar::make()
                            ->show(false)
                    )
            );
    }
```

Pass a `Hasnayeen\GlowChart\Chart` object to `chart` method and set the type of chart using `Hasnayeen\GlowChart\Enums\ChartType` enum. You can chain other methods to set other options.

Next, you must provide your data via `series` method:

```php
    protected function getOptions(): Options
    {
        return Options::make('BlogPostsChart')
            ->series(
                Series::make()
                    ->name('Blog Posts Per Month')
                    ->data(
                        [8, 12, 9, 20]
                    ),
            );
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

- [Hasnayeen](https://github.com/Hasnayeen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
