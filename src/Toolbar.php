<?php

namespace Hasnayeen\GlowChart;

class Toolbar
{
    private function __construct(
        public bool $show = false,
        public int $offsetX = 0,
        public int $offsetY = 0,
        public array $tools = [],
        public array $export = [],
        public string $autoSelected = 'zoom'
    ) {
    }

    public static function make(): self
    {
        return new static();
    }

    public function show(bool $condition): self
    {
        $this->show = $condition;

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

    public function tools(array $tools): self
    {
        $this->tools = $tools;

        return $this;
    }

    public function export(array $export): self
    {
        $this->export = $export;

        return $this;
    }

    public function autoSelected(string $autoSelected): self
    {
        $this->autoSelected = $autoSelected;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'show' => $this->show,
            'offsetX' => $this->offsetX,
            'offsetY' => $this->offsetY,
            'tools' => $this->tools,
            'export' => $this->export,
            'autoSelected' => $this->autoSelected,
        ];
    }
}
