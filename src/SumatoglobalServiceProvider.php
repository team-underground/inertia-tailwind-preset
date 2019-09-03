<?php

namespace Sumatoglobal\SumatoPreset;

use Sumatoglobal\Preset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class SumatoglobalServiceProvider extends ServiceProvider
{ 
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('sumato', function($command) {
            Preset::install();
            $command->info('Sumato scaffolding installed successfully.');
            $command->info('Please run "npm install && npx tailwind init && npm run dev" to compile your fresh scaffolding.');
        });
    }
}
