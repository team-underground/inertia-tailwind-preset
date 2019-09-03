<?php

namespace Sumatoglobal\InertiaTailwindPreset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function install()
    {   
        static::cleanSassDirectory();
        static::updatePackages();
        static::updateBootstrapping();
        static::updateWelcomePage();
        static::updateGitignore();
        static::scaffoldComponents();
        static::scaffoldRoutes();
        static::removeNodeModules();
    }

    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass'));
    }

    public static function updatePackageArray($packages)
    {
        return array_merge([
            '@babel/plugin-syntax-dynamic-import' => '^7.2.0',
            '@inertiajs/inertia' => '^0.1.0',
            '@inertiajs/inertia-vue' => '^0.1.0',
            'vue-template-compiler' => '^2.6.10',
            'tailwindcss' => '^1.1.2'
        ], Arr::except($packages, [
            'bootstrap',
            'popper.js',
            'lodash',
            'jquery'
        ])); 
    }

    public static function updateBootstrapping()
    { 
        copy(__DIR__ . '/stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__ . '/stubs/resources/js/app.js', resource_path('js/app.js'));
        copy(__DIR__ . '/stubs/resources/sass/app.scss', resource_path('sass/app.scss'));
        copy(__DIR__ . '/stubs/resources/sass/_nprogress.scss', resource_path('sass/_nprogress.scss'));
    }

    protected static function updateWelcomePage()
    {
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));
        copy(__DIR__ . '/stubs/resources/views/app.blade.php', resource_path('views/app.blade.php'));
    }

    protected static function updateGitignore()
    {
        file_put_contents(
            base_path('.gitignore'),
            file_get_contents(__DIR__ . '/stubs/.gitignore'),
            FILE_APPEND
        );
    }

    protected static function scaffoldComponents()
    {
        tap(new Filesystem, function ($fs) {
            $fs->deleteDirectory(resource_path('js/components'));
            $fs->copyDirectory(__DIR__ . '/stubs/resources/js/Shared', resource_path('js/Shared'));
            $fs->copyDirectory(__DIR__ . '/stubs/resources/js/Pages', resource_path('js/Pages'));
        });
    }

    protected static function scaffoldRoutes()
    {
        copy(__DIR__ . '/stubs/routes/web.php', base_path('routes/web.php'));
    }
}