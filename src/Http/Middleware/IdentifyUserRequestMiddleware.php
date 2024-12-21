<?php

namespace abenevaut\Infrastructure\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentifyUserRequestMiddleware
{
    /**
     * @return array<string, mixed>
     */
    protected function additionalContext(Request $request): array
    {
        $userId = '';
        if (Auth::check()) {
            $userId = Auth::user()->getAuthIdentifier();
        }

        return [
            'user-id' => $userId,
        ];
    }
}
