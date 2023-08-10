<?php

namespace Hasnayeen\GlowChart;

class Title
{
    private function __construct(
        public string $text = '',
        public string $align = 'left',
        public int $margin = 10,
        public int $offsetX = 0,
        public int $offsetY = 0,
        public bool $floating = false,
        public ?Style $style = null,
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function align(string $align): self
    {
        $this->align = $align;

        return $this;
    }

    public function margin(int $margin): self
    {
        $this->margin = $margin;

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

    public function floating(bool $floating): self
    {
        $this->floating = $floating;

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
            'text' => $this->text,
            'align' => $this->align,
            'margin' => $this->margin,
            'offsetX' => $this->offsetX,
            'offsetY' => $this->offsetY,
            'floating' => $this->floating,
            'style' => $this->style?->toArray(),
        ];
    }
}
