<?php

namespace App\Services\Email;

class ActivationEmail implements EmailStrategy
{
    public function getSubject() :string
    {
        return 'Aktivasi Akun';
    }
    public function getMessage(string $token) :string
    {
        return 'Klik link berikut untuk aktivasi akun: ' . base_url("auth/activate/$token");
    }
}
