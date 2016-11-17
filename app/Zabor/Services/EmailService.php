<?php namespace App\Zabor\Services;

use Mail;

class EmailService
{

    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }
}
