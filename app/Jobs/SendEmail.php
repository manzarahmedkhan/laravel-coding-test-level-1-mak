<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message;
    public $recipient;
    public $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient,$message,$subject)
    {
        $this->recipient = $recipient;
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send([], [], function ($mailReff){
            $mailReff->from(env('MAIL_USERNAME'), 'Event Created');
            $mailReff->to($this->recipient);
            $mailReff->subject($this->subject)
            ->setBody($this->message, 'text/html');
        });
    }
}
