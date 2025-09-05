<?php

namespace App\Services\Email;

class ResetEmail implements EmailStrategy
{
    public function getSubject() :string
    {
        return 'Reset Password';
    }
    public function getMessage(string $token) :string
    {
        return 'Klik link berikut untuk reset password: ' . base_url("auth/reset-password-form/$token");
    }
}
