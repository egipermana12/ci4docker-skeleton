<?php

namespace App\Services\Email;


use InvalidArgumentException;
use App\Services\Email\EmailSender;

class EmailServices
{
    public function send(string $type, string $toEmail, string $token) : bool
    {
        $strategy = $this->getStrategy($type);
        $sender = new EmailSender($strategy);
        return $sender->send($toEmail, $token);
    }

    private function getStrategy(string $type): EmailStrategy
    {
        return match ($type) {
            'activation' => new ActivationEmail(),
            'reset'      => new ResetEmail(),
            default      => throw new InvalidArgumentException("Unknown email type: $type"),
        };
    }
}
