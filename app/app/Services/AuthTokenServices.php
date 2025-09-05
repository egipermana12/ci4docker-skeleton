<?php

namespace App\Services;

use App\Models\UserToken;
use App\Services\Email\EmailServices;

class AuthTokenServices {

    protected $userToken;
    protected EmailServices $emailServices;

    public function __construct()
    {
        $this->userToken = new UserToken();
        $this->emailServices = new EmailServices();
    }

    public function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        return $token;
    }

    public function insertToken(array $credentials) :bool
    {
        $token = $this->generateToken();
        $data = [
            'email' => $credentials['user_email'],
            'token' => $token,
            'type' => 'verify',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $insertToken = $this->userToken->insert($data);
        if($insertToken)
        {
            return $this->emailServices->send('activation', $credentials['user_email'], $token);
        }
        return false;
    }
}
