<?php

namespace Hasnayeen\GlowChart;

class Labels
{
    private function __construct(
        public bool $show = true,
        public int $rotate = -45,
        public bool $rotateAlways = false,
        public bool $hideOverlappingLabels = true,
        public bool $showDuplicates = false,
        public bool $trim = false,
        public ?int $minHeight = null,
        public int $maxHeight = 300,
        public ?Style $style = null,
        public ?int $offsetX = null,
        public ?int $offsetY = null,
        public ?string $format = null,
        public ?string $formatter = null,
        public bool $datetimeUTC = true,
        public array $datetimeFormatter = [],
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

    public function rotate(int $rotate): self
    {
        $this->rotate = $rotate;

        return $this;
    }

    public function rotateAlways(bool $rotateAlways): self
    {
        $this->rotateAlways = $rotateAlways;

        return $this;
    }

    public function hideOverlappingLabels(bool $hideOverlappingLabels): self
    {
        $this->hideOverlappingLabels = $hideOverlappingLabels;

        return $this;
    }

    public function showDuplicates(bool $showDuplicates): self
    {
        $this->showDuplicates = $showDuplicates;

        return $this;
    }

    public function trim(bool $trim): self
    {
        $this->trim = $trim;

        return $this;
    }

    public function minHeight(?int $minHeight): self
    {
        $this->minHeight = $minHeight;

        return $this;
    }

    public function maxHeight(int $maxHeight): self
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

    public function style(Style $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function offsetX(int $offsetX): self
    {
        $this->offsetX = $offsetX;

        return $this;
    }

    public function offsetY(int $offsetY): self
    {
        $this->offsetY = $offsetY;

        return $this;
    }

    public function format(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function formatter(?string $formatter): self
    {
        $this->formatter = $formatter;

        return $this;
    }

    public function datetimeUTC(bool $datetimeUTC): self
    {
        $this->datetimeUTC = $datetimeUTC;

        return $this;
    }

    public function datetimeFormatter(
        string $year = 'yyyy',
        string $month = 'MMM \'yy',
        string $day = 'dd MMM',
        string $hour = 'HH:mm',
    ): self {
        $this->datetimeFormatter = [
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'hour' => $hour,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'show' => $this->show,
            'rotate' => $this->rotate,
            'rotateAlways' => $this->rotateAlways,
            'hideOverlappingLabels' => $this->hideOverlappingLabels,
            'showDuplicates' => $this->showDuplicates,
            'trim' => $this->trim,
            'minHeight' => $this->minHeight,
            'maxHeight' => $this->maxHeight,
            'style' => $this->style->toArray(),
            'offsetX' => $this->offsetX,
            'offsetY' => $this->offsetY,
            'format' => $this->format,
            'formatter' => $this->formatter,
            'datetimeUTC' => $this->datetimeUTC,
            'datetimeFormatter' => $this->datetimeFormatter,
        ];
    }
}
