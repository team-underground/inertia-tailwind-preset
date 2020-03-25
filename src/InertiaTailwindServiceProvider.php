<?php

namespace TeamUnderground\InertiaTailwindPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class InertiaTailwindServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('inertia-tailwind', function ($command) {
            Preset::install();
            $command->info('Inertia Tailwind scaffolding installed successfully.');
            $command->info('Please run "npm install && npx tailwind init && npm run watch" to compile your fresh scaffolding.');
        });
    }
}
