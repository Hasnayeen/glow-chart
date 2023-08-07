<?php

namespace Hasnayeen\GlowChart\Commands;

use Illuminate\Console\Command;

class GlowChartCommand extends Command
{
    public $signature = 'glow-chart';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
