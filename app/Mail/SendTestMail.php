<?php

namespace App\Mail;

use App\Http\Requests\RecordRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $mail = $request->only('name','email','message');
        return $this->view('emails.contact',compact('mail'))
                ->from($mail['email'],$mail['name'])
                ->subject('[ユーザー]問い合わせ');
    }
}
