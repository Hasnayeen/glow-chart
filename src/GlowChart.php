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

    protected static string $chartId = 'chart-widget';

    public ?string $filter = null;

    protected static string $color = 'primary';

    protected static ?string $heading = null;

    protected static ?string $description = null;

    protected static ?string $maxHeight = null;

    protected function getChartId(): string
    {
        return static::$chartId;
    }

    abstract protected function getOptions(): Options;

    protected function getChartOptions(): array
    {
        return $this->cleanOptions($this->getOptions()->toArray());
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
