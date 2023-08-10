<?php

namespace Hasnayeen\GlowChart\Enums;

enum ChartType: string
{
    case Line = 'line';
    case Bar = 'bar';
    case Pie = 'pie';
    case Area = 'area';
    case Donut = 'donut';
    case PolarArea = 'polarArea';
    case Bubble = 'bubble';
    case Scatter = 'scatter';
    case Radar = 'radar';
    case Candlestick = 'candlestick';
    case Heatmap = 'heatmap';
    case Treemap = 'treemap';
    case RangeBar = 'rangeBar';
    case RangeArea = 'rangeArea';
    case RadialBar = 'radialBar';
    case BoxPlot = 'boxPlot';
}
