# GlowChart

Apex chart integration for filament with extra batteries and Filament like api

## Hire me

I'm available for contractual work on this stack (Filament, Laravel, Livewire, AlpineJS, TailwindCSS). Reach me via [email](searching.nehal@gmail.com) or [discord](discordapp.com/users/297318343642447872)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hasnayeen/glow-chart.svg?style=for-the-badge)](https://packagist.org/packages/hasnayeen/glow-chart)
[![Filament Version](https://img.shields.io/badge/Filament-V3.x-777BB4?style=for-the-badge)](https://filamentphp.com)
[![Total Downloads](https://img.shields.io/packagist/dt/hasnayeen/glow-chart.svg?style=for-the-badge)](https://packagist.org/packages/hasnayeen/glow-chart)

## Overview

This plugin integrates [Apex Charts](https://apexcharts.com/) on Filament to provide beautiful and interactive visualizations for your data. This package provides following features

- Class based options and data setter with IDE autocompletion and docs.

- Ability to generate chart data model with fluent methods.(via `flowframe/laravel-trend`)

- Ability to set customizable filters.

- Ability to enable/disable chart for users/team.(via `laravel/penant`)

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

    protected function options(Options $options): Options
    {
        return $options
            ->chart(
                Chart::make(ChartType::{{ type }})
            );
    }

    protected function series(Series $series): Series
    {
        return $series
            ->data();
    }
}
```

The `protected static ?string $id` variable is used for referencing element to insert the Apex chart. You can override it but it should be unique from other chart on the page.

The `protected static ?string $heading` variable is used to set the heading that describes the chart.

The `options` method is used to set [Apex Charts Options](https://apexcharts.com/docs/options). The method should return an `Hasnayeen\GlowChart\Options` object. You can set all the options for available for Apex chart by using fluent methods on `Options` object.

First, you must set chart options via `chart` method:

```php
    protected function options(Options $options): Options
    {
        return $options
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
    protected function series(Series $series): Series
    {
        return $series
            ->data([120, 90, 86, 71, 65, 23, 54, 87, 60, 234, 92, 120]);
    }
```

## Setting Chart Data

You can pass data to chart in multiple ways. You already saw how to pass array, you can also pass a `Illuminate\Support\Collection` object to `data` method.

You can also generate chart data from an Eloquent model (`flowframe/laravel-trend` is used under the hood for this). If you have created the chart for resource then you already have a `resource` property, if not add one like below

```php
    protected static ?string $resource = BlogPostResource::class;
```

Now you can chain all the method from `flowframe/laravel-trend` to generate chart data from a model

```php
    protected function series(Series $series): Series
    {
        return $series
            ->trend()
            ->between(now()->subMonths(11), now())
            ->perMonth()
            ->count();
    }
```

You can also pass additional query method by providing a closure to the `trend` method

```php
    protected function series(Series $series): Series
    {
        return $series
            ->trend(fn (Builder $query) => $query->where('status', 'published'))
            ->between(now()->subMonths(11), now())
            ->perMonth()
            ->count();
    }
```

### Available methods for customizing query

You can use the following intervals:

- perMinute()
- perHour()
- perDay()
- perMonth()
- perYear()

And following aggregates:

- sum('column')
- average('column')
- max('column')
- min('column')
- count('*')


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
