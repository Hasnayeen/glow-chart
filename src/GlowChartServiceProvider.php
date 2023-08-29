<?php

namespace Hasnayeen\GlowChart;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Hasnayeen\GlowChart\Commands\GlowChartCommand;
use Hasnayeen\GlowChart\Testing\TestsGlowChart;
use Illuminate\Filesystem\Filesystem;
use Livewire\Testing\TestableLivewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GlowChartServiceProvider extends PackageServiceProvider
{
    public static string $name = 'glow-chart';

    public static string $viewNamespace = 'glow-chart';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->askToStarRepoOnGitHub('hasnayeen/glow-chart');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            [],
            $this->getAssetPackageName()
        );

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/glow-chart/{$file->getFilename()}"),
                ], 'glow-chart-stubs');
            }
        }

        // Testing
        // TestableLivewire::mixin(new TestsGlowChart());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'hasnayeen/glow-chart';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            AlpineComponent::make('glow-chart', __DIR__ . '/../resources/dist/glow-chart.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            GlowChartCommand::class,
        ];
    }
}
