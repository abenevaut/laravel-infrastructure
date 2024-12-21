<?php

namespace abenevaut\Infrastructure\App\Listeners;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Str;

/**
 * Add in AppServiceProvider::boot();
 * ```php
 * use App\Listeners\TrackCommandTelemetryAbstract;
 * use Illuminate\Support\Facades\Event;
 *
 * Event::subscribe(TrackCommandTelemetryAbstract::class);
 * ```
 */
abstract class TrackCommandTelemetryAbstract extends ListenerAbstract
{
    private static $times = [];

    /**
     * Log::info("Command [$event->command] takes $duration minutes.");
     */
    abstract protected function track(CommandFinished $event, float $duration): void;

    public function onCommandStarting(CommandStarting $event)
    {
        $identifier = $this->makeIdentifier($event);
        static::$times[$identifier] = microtime(true);
    }

    public function onCommandFinished(CommandFinished $event)
    {
        $identifier = $this->makeIdentifier($event);
        $duration = ((microtime(true) - static::$times[$identifier]) / 60);

        $this->track($event, $duration);
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            CommandStarting::class => 'onCommandStarting',
            CommandFinished::class => 'onCommandFinished',
        ];
    }

    protected function makeIdentifier(CommandStarting|CommandFinished $event): string
    {
        return Str::slug(implode(' ', $event->input->getRawTokens()));
    }
}
