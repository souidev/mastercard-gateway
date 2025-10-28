<?php

namespace Souidev\MastercardGateway\Commands;

use Illuminate\Console\Command;

class MastercardGatewayCommand extends Command
{
    public $signature = 'mastercard-gateway';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
