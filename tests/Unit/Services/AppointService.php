<?php

namespace Tests\Unit\Services;
use Mockery;
use PHPUnit\Framework\TestCase;
use App\Services\AppointService;
class AppointService extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_check_appoint_service(): void
    {
        $appoint = new AppointService();


        $mock = Mockery::mock('alias:App\Models\Appoint');
        $mock->shouldReceive('where->first')->andReturn((object)[
            'userId' => 1,
            'appointId' => 1
        ]);

        $result = $appoint->getUserId(1,1);
        $this->assertTrue($result);
    }
}
