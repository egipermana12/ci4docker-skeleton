<?php

namespace App\Services\Email;


class EmailSender
{
    private EmailStrategy $strategy;

    public function __construct(EmailStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function send(string $toEmail, string $token): bool
    {
        $emailSend = \Config\Services::email();
        $emailSend->setTo($toEmail);
        $emailSend->setFrom('no-reply@myapp.com', 'My App');
        $emailSend->setSubject($this->strategy->getSubject());
        $emailSend->setMessage($this->strategy->getMessage($token));
        return $emailSend->send();

    }
}
