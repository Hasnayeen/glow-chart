<?php

namespace Hasnayeen\GlowChart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hasnayeen\GlowChart\GlowChart
 */
class GlowChart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Hasnayeen\GlowChart\GlowChart::class;
    }
}
