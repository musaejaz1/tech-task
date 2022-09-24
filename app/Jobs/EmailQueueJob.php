<?php

namespace App\Jobs;

use App\Mail\ReceiptMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $Mail_details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Mail_details)
    {
        $this->Mail_details = $Mail_details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->Mail_details['to'])->send(new ReceiptMail($this->Mail_details['subject'], $this->Mail_details['body']));
    }
}
