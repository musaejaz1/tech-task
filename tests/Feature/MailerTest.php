<?php

namespace Tests\Feature;

use App\Mail\ReceiptMail;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailerTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function send_receipt_email()
    {

        Mail::fake();

        $response = $this
            ->from('/')
            ->post('/process-form', [
                'company_symbol' => 'GOOG',
                'start_date' => '2022-01-01',
                'end_date' => '2022-01-19',
                'email' => 'garmin008@gmail.com'
            ]);

        Mail::assertSent(ReceiptMail::class);

        $response->assertStatus(200);
    }
}
