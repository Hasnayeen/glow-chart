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

    protected static string $id = 'chart-widget';

    public ?string $filter = null;

    protected static string $color = 'primary';

    protected static ?string $heading = null;

    protected static ?string $description = null;

    protected static ?string $maxHeight = null;

    public function getChartId(): string
    {
        return static::$id;
    }

    /**
     * @return array<scalar, scalar> | null
     */
    protected function getFilters(): ?array
    {
        return null;
    }

    public function getHeading(): string | Htmlable | null
    {
        return static::$heading;
    }

    public function getDescription(): string | Htmlable | null
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
}
