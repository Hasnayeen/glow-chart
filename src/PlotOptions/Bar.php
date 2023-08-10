<?php

namespace Hasnayeen\GlowChart\PlotOptions;

class Bar
{
    private function __construct(
        public bool $horizontal = false,
        public int $borderRadius = 0,
        public string $borderRadiusApplication = 'around',
        public string $borderRadiusWhenStacked = 'last',
        public string $columnWidth = '70%',
        public string $barHeight = '70%',
        public bool $distributed = false,
        public bool $rangeBarOverlap = true,
        public bool $rangeBarGroupRows = false,
        public bool $hideZeroBarsWhenGrouped = false,
        public bool $isDumbbell = false,
        public ?array $dumbbellColors = null,
        public bool $isFunnel = false,
        public bool $isFunnel3d = true,
        public array $colors = [],
        public ?DataLabels $dataLabels = null,
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function horizontal(bool $horizontal): self
    {
        $this->horizontal = $horizontal;

        return $this;
    }

    public function borderRadius(int $borderRadius): self
    {
        $this->borderRadius = $borderRadius;

        return $this;
    }

    public function borderRadiusApplication(string $borderRadiusApplication): self
    {
        $this->borderRadiusApplication = $borderRadiusApplication;

        return $this;
    }

    public function borderRadiusWhenStacked(string $borderRadiusWhenStacked): self
    {
        $this->borderRadiusWhenStacked = $borderRadiusWhenStacked;

        return $this;
    }

    public function columnWidth(string $columnWidth): self
    {
        $this->columnWidth = $columnWidth;

        return $this;
    }

    public function barHeight(string $barHeight): self
    {
        $this->barHeight = $barHeight;

        return $this;
    }

    public function distributed(bool $distributed): self
    {
        $this->distributed = $distributed;

        return $this;
    }

    public function rangeBarOverlap(bool $rangeBarOverlap): self
    {
        $this->rangeBarOverlap = $rangeBarOverlap;

        return $this;
    }

    public function rangeBarGroupRows(bool $rangeBarGroupRows): self
    {
        $this->rangeBarGroupRows = $rangeBarGroupRows;

        return $this;
    }

    public function hideZeroBarsWhenGrouped(bool $hideZeroBarsWhenGrouped): self
    {
        $this->hideZeroBarsWhenGrouped = $hideZeroBarsWhenGrouped;

        return $this;
    }

    public function isDumbbell(bool $isDumbbell): self
    {
        $this->isDumbbell = $isDumbbell;

        return $this;
    }

    public function dumbbellColors(?array $dumbbellColors): self
    {
        $this->dumbbellColors = $dumbbellColors;

        return $this;
    }

    public function isFunnel(bool $isFunnel): self
    {
        $this->isFunnel = $isFunnel;

        return $this;
    }

    public function isFunnel3d(bool $isFunnel3d): self
    {
        $this->isFunnel3d = $isFunnel3d;

        return $this;
    }

    /**
     * Set the color ranges for the chart.
     *
     * @param  array  $ranges An array of color ranges. Each range is defined by an array with the following keys:
     *   ranges (array)
     *   + from (int) - Value indicating range’s upper limit
     *   + to (int) - Value indicating range’s lower limit
     *   + color (string) - Color to be used for the range
     */
    public function colorsRanges(array $ranges): self
    {
        $this->colors['ranges'] = $ranges;

        return $this;
    }

    /**
     * Custom colors for background rects. The number of colors in the array is repeated if fewer colors than data points are specified.
     */
    public function backgroundBarColors(array $backgroundBarColors): self
    {
        $this->colors['backgroundBarColors'] = $backgroundBarColors;

        return $this;
    }

    /**
     * Opacity for background colors of the bar.
     */
    public function backgroundBarOpacity(float $backgroundBarOpacity): self
    {
        $this->colors['backgroundBarOpacity'] = $backgroundBarOpacity;

        return $this;
    }

    /**
     * Border radius for background rect of the bar.
     */
    public function backgroundBarRadius(int $backgroundBarRadius): self
    {
        $this->colors['backgroundBarRadius'] = $backgroundBarRadius;

        return $this;
    }

    public function dataLabels(?DataLabels $dataLabels): self
    {
        $this->dataLabels = $dataLabels;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'horizontal' => $this->horizontal,
            'borderRadius' => $this->borderRadius,
            'borderRadiusApplication' => $this->borderRadiusApplication,
            'borderRadiusWhenStacked' => $this->borderRadiusWhenStacked,
            'columnWidth' => $this->columnWidth,
            'barHeight' => $this->barHeight,
            'distributed' => $this->distributed,
            'rangeBarOverlap' => $this->rangeBarOverlap,
            'rangeBarGroupRows' => $this->rangeBarGroupRows,
            'hideZeroBarsWhenGrouped' => $this->hideZeroBarsWhenGrouped,
            'isDumbbell' => $this->isDumbbell,
            'dumbbellColors' => $this->dumbbellColors,
            'isFunnel' => $this->isFunnel,
            'isFunnel3d' => $this->isFunnel3d,
            'colors' => $this->colors,
            'dataLabels' => $this->dataLabels?->toArray(),
        ];
    }
}
