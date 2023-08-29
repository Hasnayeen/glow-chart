<?php

namespace Hasnayeen\GlowChart;

class Options
{
    private function __construct(
        public ?Chart $chart = null,
        public ?Series $series = null,
        public ?Tooltip $tooltip = null,
        public ?Xaxis $xaxis = null,
        public ?Yaxis $yaxis = null,
        public ?array $colors = null,
        public ?PlotOptions $plotOptions = null,
        public ?Title $title = null,
        public ?Title $subtitle = null,
        public ?Stroke $stroke = null,
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function chart(Chart $chart): self
    {
        $this->chart = $chart;

        return $this;
    }

    public function series(Series $series): self
    {
        $this->series = $series;

        return $this;
    }

    public function tooltip(Toolbar $tooltip): self
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    public function xaxis(Xaxis $xaxis): self
    {
        $this->xaxis = $xaxis;

        return $this;
    }

    public function yaxis(Yaxis $yaxis): self
    {
        $this->yaxis = $yaxis;

        return $this;
    }

    public function colors(array $colors): self
    {
        $this->colors = $colors;

        return $this;
    }

    public function plotOptions(PlotOptions $plotOptions): self
    {
        $this->plotOptions = $plotOptions;

        return $this;
    }

    public function title(Title $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function subtitle(Title $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function stroke(Stroke $stroke): self
    {
        $this->stroke = $stroke;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'chart' => $this->chart?->toArray() ?? null,
            'series' => $this->series?->toArray() ?? null,
            'tooltip' => $this->tooltip?->toArray() ?? null,
            'xaxis' => $this->xaxis?->toArray() ?? null,
            'yaxis' => $this->yaxis?->toArray() ?? null,
            'colors' => $this->colors ?? null,
            'plotOptions' => $this->plotOptions?->toArray() ?? null,
            'title' => $this->title?->toArray() ?? null,
            'subtitle' => $this->subtitle?->toArray() ?? null,
            'stroke' => $this->stroke?->toArray() ?? null,
        ];
    }
}
