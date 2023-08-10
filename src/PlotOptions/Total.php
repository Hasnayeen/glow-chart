<?php

namespace Hasnayeen\GlowChart\PlotOptions;

use Hasnayeen\GlowChart\Style;
use Illuminate\Support\Arr;

class Total
{
    private function __construct(
        public bool $enabled = false,
        public $formatter = null,
        public int $offsetX = 0,
        public int $offsetY = 0,
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

    public function formatter(string $formatter): self
    {
        $this->formatter = $formatter;

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

    public function style(Style $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled,
            'formatter' => $this->formatter,
            'offsetX' => $this->offsetX,
            'offsetY' => $this->offsetY,
            'style' => $this->style ? Arr::only($this->style->toArray(), ['color', 'fontSize', 'fontFamily', 'fontWeight']) : null,
        ];
    }
}
