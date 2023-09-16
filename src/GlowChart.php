<?php

namespace Hasnayeen\GlowChart;

use Filament\Widgets\Concerns\CanPoll;
use Filament\Widgets\Widget;
use Illuminate\Contracts\Support\Htmlable;

abstract class GlowChart extends Widget
{
    use CanPoll;

    /**
     * @var view-string
     */
    protected static string $view = 'glow-chart::chart-widget';

    protected static ?string $resource = null;

    protected static string $chartId = 'chart-widget';

    public ?string $filter = null;

    public string $dataChecksum;

    protected static string $color = 'primary';

    protected static ?string $heading = null;

    protected static ?string $description = null;

    protected static ?string $maxHeight = null;

    protected Options $options;

    protected Series $series;

    public function __construct()
    {
        $this->options = Options::make();
        $this->series = Series::make()
            ->when(
                $this->getResource(),
                fn ($series) => $series->model(static::$resource::getModel())
            );
    }

    public function mount(): void
    {
        $this->dataChecksum = $this->generateDataChecksum();
    }

    protected function generateDataChecksum(): string
    {
        return md5(json_encode($this->getCachedSeries()));
    }

    /**
     * @return array<string, mixed>
     */
    protected function getCachedSeries(): array
    {
        if (isset($this->series)) {
            return $this->series->toArray();
        }

        return [];
    }

    protected function getChartId(): string
    {
        return static::$chartId;
    }

    protected function getResource(): ?string
    {
        return static::$resource;
    }

    abstract protected function options(Options $options): Options;

    abstract protected function series(Series $series): Series;

    protected function getChartOptions(): array
    {
        $options = $this->options($this->options);
        $options->series($this->series($this->series));

        return $this->cleanOptions($options->toArray());
    }

    /**
     * @return array<scalar, scalar> | null
     */
    protected function getFilters(): ?array
    {
        return null;
    }

    protected function getHeading(): string | Htmlable | null
    {
        return static::$heading;
    }

    protected function getDescription(): string | Htmlable | null
    {
        return static::$description;
    }

    protected function getMaxHeight(): ?string
    {
        return static::$maxHeight;
    }

    public function getColor(): string
    {
        return static::$color;
    }

    public function updateChartSeries(): void
    {
        $newDataChecksum = $this->generateDataChecksum();

        if ($newDataChecksum !== $this->dataChecksum) {
            $this->dataChecksum = $newDataChecksum;

            $this->dispatch('updateSeries', data: $this->getCachedSeries());
        }
    }

    private function cleanOptions(array $options): array
    {
        foreach ($options as &$value) {
            if (is_array($value)) {
                $value = $this->cleanOptions($value);
            }
        }

        return array_filter($options, fn ($option) => $option !== null);
    }
}
