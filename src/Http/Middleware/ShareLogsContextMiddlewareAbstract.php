<?php

namespace abenevaut\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

abstract class ShareLogsContextMiddlewareAbstract
{
    /**
     * @return array<string, string>
     */
    abstract protected function additionalContext(Request $request): array;

    public function handle(Request $request, Closure $next): Response
    {
        $sharedContext = array_merge(
            $this->requestHitId(),
            $this->additionalContext($request)
        );

        Log::shareContext($sharedContext);

        /** @var Response $response */
        $response = $next($request);
        $response->header('REQUEST-HIT-ID', $sharedContext['request-hit-id']);

        return $response;
    }

    /**
     * @return array<string, string>
     */
    protected function requestHitId(): array
    {
        return [
            'request-hit-id' => (string) Str::ulid()
        ];
    }
}
