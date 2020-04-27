<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\StatusMail;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to_email = $this->details['toEmail'];
        $subject = $this->details['subject'];
        $data = $this->details['data'];
        Mail::send('mails.status', $data, function($message) use ($to_email, $subject){
              $message->to($to_email)
                      ->subject($subject);
              $message->from('naoresponder.lmts@gmail.com','Solicita - LMTS');
            });
    }

}

