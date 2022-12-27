<?php

namespace abenevaut\Infrastructure\App\Providers;

use Mortexa\LaravelArkitect\Console\MakeArkitectRule;
use Mortexa\LaravelArkitect\Console\TestArchitecture;
use Illuminate\Support\ServiceProvider;

class ArkitectServiceProvider extends ServiceProvider
{
    private string $configVendorPath = __DIR__ . '/../../../config/';

    public function register(): void
    {
        $this
            ->mergeConfigFrom($this->makeConfigPath('arkitect.php'), 'arkitect')
        ;
    }

    public function boot(): void
    {
        $this
            ->registerConfigs()
            ->registerCommands()
        ;
    }

    private function registerCommands(): self
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestArchitecture::class,
                MakeArkitectRule::class,
            ]);
        }

        return $this;
    }

    private function registerConfigs(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->makeConfigPath('arkitect.php') => $this->app->configPath('arkitect.php'),
            ], 'config');
        }

        return $this;
    }

    private function makeConfigPath(string $file): string
    {
        return $this->configVendorPath . $file;
    }
}
