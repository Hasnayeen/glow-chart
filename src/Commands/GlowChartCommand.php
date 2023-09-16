<?php

namespace Hasnayeen\GlowChart\Commands;

use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Filament\Support\Commands\Concerns\CanValidateInput;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class GlowChartCommand extends Command
{
    use CanManipulateFiles;
    use CanValidateInput;

    public $signature = 'make:glow-chart {name?} {--R|resource=} {--panel=} {--F|force}';

    public $description = 'Create a new glow chart widget';

    public function handle(): int
    {
        $widget = (string) str($this->argument('name') ?? $this->askRequired('Name (e.g. `BlogPostsChart`)', 'name'))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $widgetClass = (string) str($widget)->afterLast('\\');
        $widgetNamespace = str($widget)->contains('\\')
            ? (string) str($widget)->beforeLast('\\')
            : '';

        $resource = null;
        $resourceClass = null;

        if (class_exists(Resource::class)) {
            $resourceInput = $this->option('resource') ?? $this->ask('(Optional) Resource (e.g. `BlogPostResource`)');

            if ($resourceInput !== null) {
                $resource = (string) str($resourceInput)
                    ->studly()
                    ->trim('/')
                    ->trim('\\')
                    ->trim(' ')
                    ->replace('/', '\\');

                if (! str($resource)->endsWith('Resource')) {
                    $resource .= 'Resource';
                }

                $resourceClass = (string) str($resource)
                    ->afterLast('\\');
            }
        }

        $panel = null;

        if (class_exists(Panel::class)) {
            $panel = $this->option('panel');

            if ($panel) {
                $panel = Filament::getPanel($panel);
            }

            if (! $panel) {
                $panels = Filament::getPanels();

                /** @var ?Panel $panel */
                $panel = $panels[$this->choice(
                    'Where would you like to create this?',
                    array_unique([
                        ...array_map(
                            fn (Panel $panel): string => "The [{$panel->getId()}] panel",
                            $panels,
                        ),
                        '' => '[App\\Livewire] alongside other Livewire components',
                    ]),
                )] ?? null;
            }
        }

        $path = null;
        $namespace = null;
        $resourcePath = null;
        $resourceNamespace = null;

        if (! $panel) {
            $path = app_path('Livewire/');
            $namespace = 'App\\Livewire';
        } elseif ($resource === null) {
            $widgetDirectories = $panel->getWidgetDirectories();
            $widgetNamespaces = $panel->getWidgetNamespaces();

            $namespace = (count($widgetNamespaces) > 1) ?
                $this->choice(
                    'Which namespace would you like to create this in?',
                    $widgetNamespaces,
                ) :
                (Arr::first($widgetNamespaces) ?? 'App\\Filament\\Widgets');
            $path = (count($widgetDirectories) > 1) ?
                $widgetDirectories[array_search($namespace, $widgetNamespaces)] :
                (Arr::first($widgetDirectories) ?? app_path('Filament/Widgets/'));
        } else {
            $resourceDirectories = $panel->getResourceDirectories();
            $resourceNamespaces = $panel->getResourceNamespaces();

            $resourceNamespace = (count($resourceNamespaces) > 1) ?
                $this->choice(
                    'Which namespace would you like to create this in?',
                    $resourceNamespaces,
                ) :
                (Arr::first($resourceNamespaces) ?? 'App\\Filament\\Resources');
            $resourcePath = (count($resourceDirectories) > 1) ?
                $resourceDirectories[array_search($resourceNamespace, $resourceNamespaces)] :
                (Arr::first($resourceDirectories) ?? app_path('Filament/Resources/'));
        }

        $view = str($widget)->prepend(
            (string) str($resource === null ? ($panel ? "{$namespace}\\" : 'livewire\\') : "{$resourceNamespace}\\{$resource}\\widgets\\")
                ->replaceFirst('App\\', '')
        )
            ->replace('\\', '/')
            ->explode('/')
            ->map(fn ($segment) => Str::lower(Str::kebab($segment)))
            ->implode('.');

        $path = (string) str($widget)
            ->prepend('/')
            ->prepend($resource === null ? $path : "{$resourcePath}\\{$resource}\\Widgets\\")
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $viewPath = resource_path(
            (string) str($view)
                ->replace('.', '/')
                ->prepend('views/')
                ->append('.blade.php'),
        );

        if (! $this->option('force') && $this->checkForCollision([
            $path,
            $viewPath,
        ])) {
            return static::INVALID;
        }

        $chart = $this->choice(
            'Chart type',
            [
                'Line Chart',
                'Bar Chart',
                'Pie Chart',
                'Area Chart',
                'Donut Chart',
                'Polar Area Chart',
                'Bubble Chart',
                'Scatter Chart',
                'Radar Chart',
                'Candlestick Chart',
                'Heatmap Chart',
                'Treemap Chart',
                'Range Bar Chart',
                'Range Area Chart',
                'Radial Bar Chart',
                'Box Plot Chart',
            ],
        );

        $this->copyStubToApp($resource ? 'Resource' : '' . 'GlowChart', $path, [
            'class' => $widgetClass,
            'resource' => $resource,
            'namespace' => filled($resource) ? "{$resourceNamespace}\\{$resource}\\Widgets" . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : '') : $namespace . ($widgetNamespace !== '' ? "\\{$widgetNamespace}" : ''),
            'type' => match ($chart) {
                'Line Chart' => 'Line',
                'Bar Chart' => 'Bar',
                'Pie Chart' => 'Pie',
                'Area Chart' => 'Area',
                'Donut Chart' => 'Donut',
                'Polar Area Chart' => 'PolarArea',
                'Bubble Chart' => 'Bubble',
                'Scatter Chart' => 'Scatter',
                'Radar Chart' => 'Radar',
                'Candlestick Chart' => 'Candlestick',
                'Heatmap Chart' => 'Heatmap',
                'Treemap Chart' => 'Treemap',
                'Range Bar Chart' => 'RangeBar',
                'Range Area Chart' => 'RangeArea',
                'Radial Bar Chart' => 'RadialBar',
                'Box Plot Chart' => 'BoxPlot',
                default => 'Line',
            },
        ]);

        $this->components->info("Successfully created {$widget}!");

        if ($resource !== null) {
            $this->components->info("Make sure to register the widget in `{$resourceClass}::getWidgets()`, and then again in `getHeaderWidgets()` or `getFooterWidgets()` of any `{$resourceClass}` page.");
        }

        return static::SUCCESS;
    }
}
