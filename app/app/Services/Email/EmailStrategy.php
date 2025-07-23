<?php

namespace App\Services\Email;

interface EmailStrategy {
    public function getSubject() :string;
    public function getMessage(string $token) :string;
}
