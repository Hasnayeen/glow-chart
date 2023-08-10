<?php

namespace Hasnayeen\GlowChart;

use Illuminate\Support\Arr;

class Tooltip
{
    private function __construct(
        public bool $enabled = true,
        public ?string $enabledOnSeries = null,
        public bool $shared = true,
        public bool $followCursor = false,
        public bool $intersect = false,
        public bool $inverseOrder = false,
        public ?string $custom = null,
        public bool $fillSeriesColor = false,
        public bool $theme = false,
        public ?Style $style = null,
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function enabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function enabledOnSeries(?string $enabledOnSeries): self
    {
        $this->enabledOnSeries = $enabledOnSeries;

        return $this;
    }

    public function shared(bool $shared): self
    {
        $this->shared = $shared;

        return $this;
    }

    public function followCursor(bool $followCursor): self
    {
        $this->followCursor = $followCursor;

        return $this;
    }

    public function intersect(bool $intersect): self
    {
        $this->intersect = $intersect;

        return $this;
    }

    public function inverseOrder(bool $inverseOrder): self
    {
        $this->inverseOrder = $inverseOrder;

        return $this;
    }

    public function custom(?string $custom): self
    {
        $this->custom = $custom;

        return $this;
    }

    public function fillSeriesColor(bool $fillSeriesColor): self
    {
        $this->fillSeriesColor = $fillSeriesColor;

        return $this;
    }

    public function theme(bool $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function style(Style $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled,
            'enabledOnSeries' => $this->enabledOnSeries,
            'shared' => $this->shared,
            'followCursor' => $this->followCursor,
            'intersect' => $this->intersect,
            'inverseOrder' => $this->inverseOrder,
            'custom' => $this->custom,
            'fillSeriesColor' => $this->fillSeriesColor,
            'theme' => $this->theme,
            'style' => Arr::only($this->style?->toArray(), ['fontSize', 'fontFamily']),
        ];
    }
}
