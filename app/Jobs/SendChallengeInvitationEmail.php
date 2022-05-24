<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ChallengeInvitation;
use Mail;
class SendChallengeInvitationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $send_mail;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail, $user, $challenge)
    {
        $this->send_mail = $send_mail;
        $this->user = $user;
        $this->challenge = $challenge;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->send_mail)->send(new ChallengeInvitation($this->user));
    }
}
