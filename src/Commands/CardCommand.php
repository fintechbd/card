<?php

namespace Fintech\Card\Commands;

use Illuminate\Console\Command;

class CardCommand extends Command
{
    public $signature = 'card';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
