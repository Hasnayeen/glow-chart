<?php

namespace Hasnayeen\GlowChart;

class Series
{
    private function __construct(
        public ?string $name,
        public array $data,
    ) {
    }

    public static function make(string $name = null, ?array $data = []): self
    {
        return new static($name, $data);
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function data(array $data): self
    {
        $this->data = [
            'name' => $this->name,
            'data' => $data,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return [
            $this->data,
        ];
    }
}
