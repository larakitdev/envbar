<?php

namespace LaraKit\EnvBar\Console;

use Illuminate\Console\Command;

class EnvBarPublish extends Command
{
    protected $signature = 'envbar:publish';

    protected $description = 'Publish the EnvBar assets';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => 'LaraKit\EnvBar\EnvBarServiceProvider',
            '--tag'      => 'assets',
        ]);
    }
}
