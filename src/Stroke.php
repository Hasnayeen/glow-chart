<?php

namespace Hasnayeen\GlowChart;

class Stroke
{
    private function __construct(
        public bool $show = true,
        public string | array $curve = 'smooth',
        public string $lineCap = 'butt',
        public array $colors = [],
        public int | array $width = 2,
        public int | array $dashArray = 0,
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    /**
     * Colors to fill the border for paths.
     */
    public function colors(array $colors): self
    {
        $this->colors = $colors;

        return $this;
    }

    /**
     * Whether to show the lines and area fills or not
     */
    public function show(string $show): self
    {
        $this->show = $show;

        return $this;
    }

    /**
     *  In line / area charts, whether to draw smooth lines or straight lines
     *  Available Options:
     *      smooth: connects the points in a curve fashion. Also known as spline
     *      straight: connect the points in straight lines.
     *      stepline: points are connected by horizontal and vertical line segments, looking like steps of a staircase.
     *  You can also pass an array in stroke.curve, where each index corresponds to the series-index in multi-series charts.
     *
     * @example 'smooth' or ['smooth', 'straight', 'stepline']
     */
    public function curve(string $curve): self
    {
        $this->curve = $curve;

        return $this;
    }

    /**
     *  For setting the starting and ending points of stroke
     *  Available Options:
     *      butt: ends the stroke with a 90-degree angle
     *      square: similar to butt except that it extends the stroke beyond the length of the path
     *      round: ends the path-stroke with a radius that smooths out the start and end points
     */
    public function lineCap(int $lineCap): self
    {
        $this->lineCap = $lineCap;

        return $this;
    }

    /**
     * Sets the width of border for svg path.
     * N.B: array valid only for line/area charts
     */
    public function width(int | array $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Creates dashes in borders of svg path. Higher number creates more space between dashes in the border.
     */
    public function dashArray(int | array $dashArray): self
    {
        $this->dashArray = $dashArray;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'show' => $this->show,
            'curve' => $this->curve,
            'lineCap' => $this->lineCap,
            'colors' => empty($this->colors) ? null : $this->colors,
            'width' => $this->width,
            'dashArray' => $this->dashArray,
        ];
    }
}
