<?php

namespace Hasnayeen\GlowChart;

use Hasnayeen\GlowChart\Enums\ChartType;

class Chart
{
    private function __construct(
        public string $type,
        public string $height = '300',
        public ?Toolbar $toolbar = null,
    ) {
    }

    public static function make(ChartType $type): self
    {
        return new static($type->value);
    }

    public function type(ChartType $type): self
    {
        $this->type = $type->value;

        return $this;
    }

    public function height(string $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function toolbar(Toolbar $toolbar): self
    {
        $this->toolbar = $toolbar;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'height' => $this->height,
            'toolbar' => $this->toolbar->toArray() ?? null,
        ];
    }
}
