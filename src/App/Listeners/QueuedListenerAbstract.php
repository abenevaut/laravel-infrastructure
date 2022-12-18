<?php

namespace abenevaut\Infrastructure\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

abstract class QueuedListenerAbstract implements ShouldQueue
{
    use InteractsWithQueue;

    abstract function handle($event): void;
}
