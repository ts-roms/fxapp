<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     * @skip
     */
    public function testBasicTest()
    {
        $this->markTestSkipped();
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
