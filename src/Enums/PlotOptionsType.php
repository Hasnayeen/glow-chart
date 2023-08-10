<?php

namespace Hasnayeen\GlowChart\Enums;

enum PlotOptionsType: string
{
    case Area = 'area';
    case Bar = 'bar';
    case Bubble = 'bubble';
    case Candlestick = 'candlestick';
    case BoxPlot = 'boxPlot';
    case Heatmap = 'heatmap';
    case TreeMap = 'treemap';
    case Pie = 'pie';
    case PolarArea = 'polarArea';
    case Radar = 'radar';
    case RadialBar = 'radialBar';
}
