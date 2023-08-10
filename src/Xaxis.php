<?php

namespace Hasnayeen\GlowChart;

use Hasnayeen\GlowChart\Enums\TickPlacement;
use Hasnayeen\GlowChart\Enums\XaxisType;

class Xaxis
{
    private function __construct(
        public XaxisType $type = XaxisType::Category,
        public array $categories = [],
        public ?int $tickAmount = null,
        public TickPlacement $tickPlacement = TickPlacement::On,
        public ?int $min = null,
        public ?int $max = null,
        public ?int $range = null,
        public bool $floating = false,
        public ?int $decimalsInFloat = null,
        public ?bool $overwriteCategories = null,
        public string $position = 'bottom',
        public ?Labels $labels = null,
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function type(XaxisType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function categories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function tickAmount(?int $tickAmount): self
    {
        $this->tickAmount = $tickAmount;

        return $this;
    }

    public function tickPlacement(TickPlacement $tickPlacement): self
    {
        $this->tickPlacement = $tickPlacement;

        return $this;
    }

    public function min(?int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function max(?int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function range(?int $range): self
    {
        $this->range = $range;

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

    public function overwriteCategories(?bool $overwriteCategories): self
    {
        $this->overwriteCategories = $overwriteCategories;

        return $this;
    }

    public function position(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function labels(Labels $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'categories' => $this->categories,
            'tickAmount' => $this->tickAmount,
            'tickPlacement' => $this->tickPlacement->value,
            'min' => $this->min,
            'max' => $this->max,
            'range' => $this->range,
            'floating' => $this->floating,
            'decimalsInFloat' => $this->decimalsInFloat,
            'overwriteCategories' => $this->overwriteCategories,
            'position' => $this->position,
            'labels' => $this->labels?->toArray() ?? null,
        ];
    }
}
