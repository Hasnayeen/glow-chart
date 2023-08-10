<?php

namespace Hasnayeen\GlowChart\PlotOptions;

class DataLabels
{
    private function __construct(
        public string $position = 'top',
        public int $maxItems = 100,
        public bool $hideOverflowingLabels = true,
        public string $orientation = 'horizontal',
        public ?Total $total = null,
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function position(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function maxItems(int $maxItems): self
    {
        $this->maxItems = $maxItems;

        return $this;
    }

    public function hideOverflowingLabels(bool $hideOverflowingLabels): self
    {
        $this->hideOverflowingLabels = $hideOverflowingLabels;

        return $this;
    }

    public function orientation(string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function total(Total $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'position' => $this->position,
            'maxItems' => $this->maxItems,
            'hideOverflowingLabels' => $this->hideOverflowingLabels,
            'orientation' => $this->orientation,
            'total' => $this->total?->toArray() ?? null,
        ];
    }
}
