<?php

namespace abenevaut\Infrastructure\App\Listeners;

abstract class ListenerAbstract
{
    abstract function handle($event): void;
}
