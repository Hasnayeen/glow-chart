<?php

namespace Hasnayeen\GlowChart\Exceptions;

use Hasnayeen\GlowChart\Enums\PlotOptionsType;

class IncorrectPlotOptionsType extends \Exception
{
    public function __construct(
        public PlotOptionsType $givenType,
        public PlotOptionsType $expectedType,
    ) {
        parent::__construct("Cannot set options for {$givenType->value} plot type. Expected {$expectedType->value} plot type.");
    }
}
