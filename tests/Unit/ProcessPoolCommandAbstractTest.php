<?php

namespace Tests\Unit;

use abenevaut\Infrastructure\Console\ProcessPoolCommandAbstract;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class ProcessPoolCommandAbstractTest extends TestCase
{
    public function testQueueLengthIsDefinedToZero()
    {
        $stub = $this->createPartialMock(ProcessPoolCommandAbstract::class, ['boot', 'defaultConcurrency']);

        $this->assertIsInt($stub->getQueueLength());
        $this->assertEquals(0, $stub->getQueueLength());
        $this->assertSame("0 process to compute", $stub->title());
    }

    public function testToAddTowProcesses()
    {
        $stub = $this->createPartialMock(ProcessPoolCommandAbstract::class, ['boot', 'defaultConcurrency']);

        $stub->push([
            new Process(['ls']),
            new Process(['ls', '-la']),
        ]);

        $this->assertIsInt($stub->getQueueLength());
        $this->assertEquals(2, $stub->getQueueLength());
        $this->assertSame("2 process to compute", $stub->title());
    }
}
