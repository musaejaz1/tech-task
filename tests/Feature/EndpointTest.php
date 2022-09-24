<?php

namespace Tests\Feature;

use Tests\TestCase;

class EndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_historical_data_form()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
