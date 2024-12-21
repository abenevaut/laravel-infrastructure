<?php

namespace Tests\Unit;

use abenevaut\Infrastructure\Http\Middleware\ShareLogsContextMiddlewareAbstract;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\TestCase;

class ShareLogsContextMiddlewareAbstractTest extends TestCase
{
    use WithFaker;

    public function testToRetrieveSharedContext()
    {
        Log::spy();

        $requestHitId = $this->makeFaker()->uuid;

        $middlewareStub = $this
            ->createPartialMock(
                ShareLogsContextMiddlewareAbstract::class,
                [
                    'requestHitId',
                    'additionalContext'
                ]
            );

        $middlewareStub
            ->expects($this->once())
            ->method('requestHitId')
            ->willReturn(['request-hit-id' => $requestHitId]);

        $middlewareStub
            ->expects($this->once())
            ->method('additionalContext')
            ->willReturn([]);

        /** @var Response $request */
        $response = $middlewareStub
            ->handle(
                $this->createMock(Request::class),
                function ($request) {
                    return new Response();
                }
            );

        Log::shouldHaveReceived('shareContext')->once()->withAnyArgs();

        $this->assertTrue($response->headers->has('REQUEST-HIT-ID'));
        $this->assertSame($response->headers->get('REQUEST-HIT-ID'), $requestHitId);
    }
}
