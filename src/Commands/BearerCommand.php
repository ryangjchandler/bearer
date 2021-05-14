<?php

namespace RyanChandler\Bearer\Commands;

use Illuminate\Console\Command;

class BearerCommand extends Command
{
    public $signature = 'bearer';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
