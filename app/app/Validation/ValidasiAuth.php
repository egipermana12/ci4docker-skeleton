<?php

namespace App\Validation;

class ValidasiAuth
{
    public function loginValidation() {
        $rules = [
            'user_email' => [
                'label'  => 'Rules.user_email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong!',
                    'valid_email' => 'Harus email yang valid !'
                ]
            ],
            'password' => [
                'label'  => 'Rules.password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'password tidak boleh kosong !'
                ]
            ],
        ];
        return $rules;
    }
}
