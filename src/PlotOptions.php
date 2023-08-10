<?php

namespace Hasnayeen\GlowChart;

use Hasnayeen\GlowChart\Enums\PlotOptionsType;
use Hasnayeen\GlowChart\Exceptions\IncorrectPlotOptionsType;
use Hasnayeen\GlowChart\PlotOptions\Bar;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class PlotOptions
{
    private function __construct(
        public PlotOptionsType $type,
        public array $options = [],
    ) {
    }

    public static function make(PlotOptionsType $type): self
    {
        return new static($type);
    }

    /**
     * Set the area fill options for the plot.
     *
     * @param  string  $fillTo Allowed values ['origin', 'end'].
     * When negative values are present in the area chart, this option fill the area either from 0 (origin) or from the end of the chart.
     *
     * @throws IncorrectPlotOptionsType If the plot type is not area.
     */
    public function area(string $fillTo = 'origin'): self
    {
        if ($this->type !== PlotOptionsType::Area) {
            throw new IncorrectPlotOptionsType($this->type, PlotOptionsType::Area);
        }

        if ($fillTo !== 'origin' && $fillTo !== 'end') {
            throw new InvalidParameterException('Available Options [origin, end]');
        }

        $this->options = [
            'fillTo' => $fillTo,
        ];

        return $this;
    }

    /**
     * Set the options for a bar plot.
     *
     * @throws IncorrectPlotOptionsType If the plot type is not bar.
     */
    public function bar(Bar $bar): self
    {
        if ($this->type !== PlotOptionsType::Bar) {
            throw new IncorrectPlotOptionsType($this->type, PlotOptionsType::Bar);
        }
        $this->options = $bar->toArray();

        return $this;
    }

    /**
     * Set the options for a bubble plot.
     *
     * @param  bool  $zScaling Whether to scale the bubble size based on the z-axis values.
     * @param  int  $minBubbleRadius The minimum radius of the bubbles.
     * @param  int  $maxBubbleRadius The maximum radius of the bubbles.
     *
     * @throws IncorrectPlotOptionsType If the plot type is not bubble.
     */
    public function bubble(bool $zScaling, int $minBubbleRadius, int $maxBubbleRadius): self
    {
        if ($this->type !== PlotOptionsType::Bubble) {
            throw new IncorrectPlotOptionsType($this->type, PlotOptionsType::Bubble);
        }
        $this->options = [
            'zScaling' => $zScaling,
            'minBubbleRadius' => $minBubbleRadius,
            'maxBubbleRadius' => $maxBubbleRadius,
        ];

        return $this;
    }

    /**
     * Set the options for a candlestick plot.
     *
     * @param  string  $upwardColor The color of the upward candlesticks.
     * @param  string  $downwardColor The color of the downward candlesticks.
     * @param  bool  $useFillColor Whether to use fill color for the wick.
     *
     * @throws IncorrectPlotOptionsType If the plot type is not candlestick.
     */
    public function candlestick(string $upwardColor, string $downwardColor, bool $useFillColor = true): self
    {
        if ($this->type !== PlotOptionsType::Candlestick) {
            throw new IncorrectPlotOptionsType($this->type, PlotOptionsType::Candlestick);
        }
        $this->options = [
            'colors' => [
                'upwardColor' => $upwardColor,
                'downwardColor' => $downwardColor,
            ],
            'wick' => [
                'useFillColor' => $useFillColor,
            ],
        ];

        return $this;
    }

    public function toArray(): array
    {
        return [
            $this->type->value => $this->options,
        ];
    }
}
