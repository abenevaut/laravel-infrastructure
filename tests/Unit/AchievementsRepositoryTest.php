<?php

namespace Tests\Unit;

use abenevaut\Stripe\Providers\StripeServiceProvider;
use abenevaut\Stripe\Repositories\AchievementsRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

/**
 * https://github.com/laravel/framework/blob/9.x/tests/Foundation/FoundationApplicationTest.php
 */
class AchievementsRepositoryTest extends TestCase
{
    protected $app;

    protected function setUp(): void
    {
        $this->app = new Application();
        $this->app->register(StripeServiceProvider::class);
        $this->app->boot();
        Facade::setFacadeApplication($this->app);
    }

    public function testAll()
    {
        Http::fake([
            'https://api.benevaut.test/achievements' => Http::response([
                "data" => [
                    [
                        'uniqid' => '1',
                        'status' => 'ACHIEVEMENTS',
                        'name' => 'Test 1',
                        'images' => '',
                        'url' => '',
                        'created_at' => '',
                    ],
                    [
                        'uniqid' => '2',
                        'status' => 'ACHIEVEMENTS',
                        'name' => 'Test 2',
                        'images' => '',
                        'url' => '',
                        'created_at' => '',
                    ],
                ],
                "pagination" => [
                    "total" => 2,
                    "per_page" => 12,
                    "current_page" => 1,
                    "previous_page_url" => null,
                    "next_page_url" => null
                ]
            ]),
        ]);

        $instance = new AchievementsRepository('https://api.benevaut.test', true);
        $resources = $instance->all();

        $this->assertNotEmpty($resources->getCollection());
        $this->assertSame(2, $resources->total());
        $this->assertSame(12, $resources->perPage());
        $this->assertSame(1, $resources->currentPage());
        $this->assertSame(null, $resources->previousPageUrl());
        $this->assertSame(null, $resources->nextPageUrl());
    }
}
