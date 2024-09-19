<?php

namespace Fintech\Card\Commands;

use Fintech\Core\Traits\HasCoreSetting;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    use HasCoreSetting;

    public $signature = 'card:install';

    public $description = 'Configure the system for the `fintech/card` module';

    private string $module = 'Card';

    public function handle(): int
    {
        $this->infoMessage('Module Installation', 'RUNNING');

        $this->task('Module Installation', function () {}, 'COMPLETED');

        return self::SUCCESS;
    }
}
