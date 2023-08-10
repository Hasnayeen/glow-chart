<?php

namespace Hasnayeen\GlowChart;

class Style
{
    private function __construct(
        public array $colors = [],
        public string $fontSize = '12px',
        public string $fontFamily = 'Helvetica, Arial, sans-serif',
        public int $fontWeight = 400,
        public string $cssClass = 'apexcharts-xaxis-label',
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function colors(array $colors): self
    {
        $this->colors = $colors;

        return $this;
    }

    public function fontSize(string $fontSize): self
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    public function fontFamily(string $fontFamily): self
    {
        $this->fontFamily = $fontFamily;

        return $this;
    }

    public function fontWeight(int $fontWeight): self
    {
        $this->fontWeight = $fontWeight;

        return $this;
    }

    public function cssClass(string $cssClass): self
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'colors' => $this->colors,
            'fontSize' => $this->fontSize,
            'fontFamily' => $this->fontFamily,
            'fontWeight' => $this->fontWeight,
            'cssClass' => $this->cssClass,
        ];
    }
}
