<?php

namespace abenevaut\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

abstract class TrackRequestTelemetryMiddlewareAbstract
{
    /**
     * Log::debug("🌡️ The request '{$request->method()} {$request->uri()}' was tracked {$duration} ms");
     */
    abstract protected function track(Request $request, int $duration): void;

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        // @phpstan-ignore-next-line
        $duration = (microtime(true) - LARAVEL_START) * 1000;

        $this->track($request, $duration);

        return $response;
    }
}
