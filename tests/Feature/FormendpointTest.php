<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class FormendpointTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_historical_data_view()
    {
        $response = $this->post('/process-form', ['company_symbol' => 'GOOG', 'start_date' => '2022-09-19', 'end_date' => '2022-09-21', 'email' => 'garmin008@gmail.com'], []);

        $response->assertStatus(200);
    }
}
