<?php

namespace Hasnayeen\GlowChart;

use Symfony\Component\Routing\Exception\InvalidParameterException;

class Yaxis
{
    private function __construct(
        public bool $show = true,
        public bool $showAlways = true,
        public bool $showForNullSeries = true,
        public ?string $seriesName = null,
        public bool $opposite = false,
        public bool $reversed = false,
        public bool $logarithmic = false,
        public int $logBase = 10,
        public ?int $tickAmount = null,
        public ?int $min = null,
        public ?int $max = null,
        public bool $forceNiceScale = false,
        public bool $floating = false,
        public ?int $decimalsInFloat = null,
        public ?Labels $labels = null,
        public array $axisBorder = [],
        public array $axisTicks = [],
        public array $title = [],
        public array $crosshairs = [],
        public array $tooltip = [],
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function show(bool $show): self
    {
        $this->show = $show;

        return $this;
    }

    public function showAlways(bool $showAlways): self
    {
        $this->showAlways = $showAlways;

        return $this;
    }

    public function showForNullSeries(bool $showForNullSeries): self
    {
        $this->showForNullSeries = $showForNullSeries;

        return $this;
    }

    public function seriesName(?string $seriesName): self
    {
        $this->seriesName = $seriesName;

        return $this;
    }

    public function opposite(bool $opposite): self
    {
        $this->opposite = $opposite;

        return $this;
    }

    public function reversed(bool $reversed): self
    {
        $this->reversed = $reversed;

        return $this;
    }

    public function logarithmic(bool $logarithmic): self
    {
        $this->logarithmic = $logarithmic;

        return $this;
    }

    public function logBase(int $logBase): self
    {
        $this->logBase = $logBase;

        return $this;
    }

    public function tickAmount(int $tickAmount): self
    {
        $this->tickAmount = $tickAmount;

        return $this;
    }

    public function min(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function max(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function forceNiceScale(bool $forceNiceScale): self
    {
        $this->forceNiceScale = $forceNiceScale;

        return $this;
    }

    public function floating(bool $floating): self
    {
        $this->floating = $floating;

        return $this;
    }

    public function decimalsInFloat(?int $decimalsInFloat): self
    {
        $this->decimalsInFloat = $decimalsInFloat;

        return $this;
    }

    public function labels(Labels $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Set the Y axis border options.
     *
     * @param  bool  $show Draw a vertical border on the y-axis.
     * @param  string  $color Color of the horizontal axis border.
     * @param  int  $offsetX Sets the left offset of the axis border.
     * @param  int  $offsetY Sets the top offset of the axis border.
     */
    public function axisBorder(bool $show = true, string $color = '#78909C', int $offsetX = 0, int $offsetY = 0): self
    {
        $this->axisBorder = [
            'show' => $show,
            'color' => $color,
            'offsetX' => $offsetX,
            'offsetY' => $offsetY,
        ];

        return $this;
    }

    /**
     * Set the Y axis ticks options.
     *
     * @param  bool  $show Draw ticks on the y-axis to specify intervals.
     * @param  string  $borderType Available Options [solid, dotted].
     * @param  string  $color Color of the y-axis ticks.
     * @param  int  $width Width of the tick mark.
     * @param  int  $offsetX Sets the left offset of the tick mark.
     * @param  int  $offsetY Sets the top offset of the tick mark.
     */
    public function axisTicks(
        bool $show = true,
        string $borderType = 'solid',
        string $color = '#78909C',
        int $width = 6,
        int $offsetX = 0,
        int $offsetY = 0,
    ): self {
        if ($borderType !== 'solid' && $borderType !== 'dotted') {
            throw new InvalidParameterException('Invalid border type. Available Options [solid, dotted]');
        }

        $this->axisTicks = [
            'show' => $show,
            'borderType' => $borderType,
            'color' => $color,
            'width' => $width,
            'offsetX' => $offsetX,
            'offsetY' => $offsetY,
        ];

        return $this;
    }

    /**
     * Set the Y axis title options.
     *
     * @param  string  $text Give the y-axis a title which will be displayed below the axis labels by default.
     * @param  int  $rotate Rotate the yaxis title either 90 or -90.
     * @param  int  $offsetX Sets the left offset for y-axis title.
     * @param  int  $offsetY Sets the top offset for y-axis title.
     * @param  Style  $style Style of the y-axis title.
     */
    public function title(
        string $text = '',
        int $rotate = 0,
        int $offsetX = 0,
        int $offsetY = 0,
        Style $style = null,
    ): self {
        $this->title = [
            'text' => $text,
            'rotate' => $rotate,
            'offsetX' => $offsetX,
            'offsetY' => $offsetY,
            'style' => $style,
        ];

        return $this;
    }

    /**
     * Set the Y axis crosshairs options.
     *
     * @param  bool  $show Show crosshairs on y-axis when user moves the mouse over chart area. Note: Make sure to have yaxis tooltip enabled: 'true' to make the crosshair visible.
     * @param  string  $position Possible Options [back, front].
     * @param  string  $strokeColor Border Color of crosshairs.
     * @param  string  $strokeWidth Border Width of crosshairs.
     * @param  string  $strokeDashArray Creates dashes in borders of crosshairs. Higher number creates more space between dashes in the border.
     */
    public function crosshairs(
        bool $show = true,
        string $position = 'back',
        string $strokeColor = '#B6B6B6',
        int $strokeWidth = 1,
        int $strokeDashArray = 0,
    ): self {
        $this->crosshairs = [
            'show' => $show,
            'position' => $position,
            'stroke' => [
                'color' => $strokeColor,
                'width' => $strokeWidth,
                'dashArray' => $strokeDashArray,
            ],
        ];

        return $this;
    }

    /**
     * Set the Y axis tooltip options.
     *
     * @param  bool  $enabled Show tooltip on y-axis when user hovers over axis ticks.
     * @param  string  $offsetX Sets the top offset for y-axis tooltip.
     */
    public function tooltip(bool $enabled = true, int $offsetX = 0): self
    {
        $this->tooltip = [
            'enabled' => $enabled,
            'offsetX' => $offsetX,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'show' => $this->show,
            'showAlways' => $this->showAlways,
            'showForNullSeries' => $this->showForNullSeries,
            'seriesName' => $this->seriesName,
            'opposite' => $this->opposite,
            'reversed' => $this->reversed,
            'logarithmic' => $this->logarithmic,
            'logBase' => $this->logBase,
            'tickAmount' => $this->tickAmount,
            'min' => $this->min,
            'max' => $this->max,
            'forceNiceScale' => $this->forceNiceScale,
            'floating' => $this->floating,
            'decimalsInFloat' => $this->decimalsInFloat,
            'labels' => $this->labels?->toArray() ?? [],
            'axisBorder' => $this->axisBorder,
            'axisTicks' => $this->axisTicks,
            'title' => $this->title,
            'crosshairs' => $this->crosshairs,
            'tooltip' => $this->tooltip,
        ];
    }
}
