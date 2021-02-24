<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// Use App\Models\User;
class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $Name;
    protected $OtpCode;
    protected $ExpTime;

    public function __construct($Name, $OtpCode,$ExpTime){
        //
        $this->name=$Name;
        $this->OtpCode=$OtpCode;
        $this->ExpTime=$ExpTime;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->from('example@example.com')
                    ->view('Mail.RegisterMail')
                    ->with([
                        'Name'=>$this->Name,
                        'OtpCode'=>$this->OtpCode,
                        'ExpTime'=>$this->ExpTime,
                    ]);
    }
}
