<?php

namespace abenevaut\Infrastructure\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentifyClientRequestMiddleware extends ShareLogsContextMiddlewareAbstract
{
    /**
     * @return array<string, int|string>
     */
    protected function additionalContext(Request $request): array
    {
        $clientId = '';
        $userID = '';
        if (Auth::guard('api')->check()) {
            $clientId = Auth::guard('api')->client()->id;
            $userID = $request->user()->getAuthIdentifier();
        }

        return [
            'client-id' => $clientId,
            'user-id' => $userID,
        ];
    }
}
