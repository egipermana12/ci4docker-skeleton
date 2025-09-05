<?php

namespace App\Services;

use CodeIgniter\HTTP\ResponseInterface;
use App\Services\AuthTokenServices;
use App\Models\User;

class AuthServices {
    protected $userModel;
    protected $userToken;

    public function __construct()
    {
        $this->userModel = new User();
        $this->userToken = new AuthTokenServices();
    }

    public function login(array $credetials) :array
    {

        $user = $this->userModel->where('user_email', $credetials['user_email'])->first();

        if(!$user || !password_verify($credetials['password'], $user['password']))
        {
            return ['status' => false, 'message' => 'Email atau password salah'] ;
        }

        if($user['is_active'] != 1)
        {
            return ['status' => false, 'message' => 'Akun belum diaktifkan'] ;
        }

        //set session
        session()->set('user_id', $user['user_id']);

        //remember me
        if(!empty($credetials['remember']))
        {
            $token = bin2hex(random_bytes(32));
            $this->userModel
                ->update($user['user_id'], ['remember_token' => hash('sha256', $token)]);
            set_cookie([
                'name' => 'remember_token',
                'value' => $token,
                'expire' => time() + 60 * 60 * 24 * 30,
                'httponly' => true
            ]);
        }

        return [
            'status' => true,
            'message' => 'Login berhasil',
            'redirect' => base_url('dashboard')
        ];
    }

    public function logout()
    {
        if (session()->has('user_id')) {
            $this->userModel->where('user_id', session()->get('user_id'))->set(['remember_token' => null])->update();
        }
        session()->destroy();
        delete_cookie('remember_token');
        return true;
    }

    public function register(array $registrations) :array
    {
        $data = [
            'user_name' => $registrations['user_name'],
            'user_email' => $registrations['user_email'],
            'password' => password_hash($registrations['password'], PASSWORD_DEFAULT),
            'user_role' => 'user',
            'is_active' => 0,
        ];

        $insertUser = $this->userModel->insert($data);
        if($insertUser)
        {
            $tokens = $this->userToken->insertToken($data);
            if($tokens)
            {
                return [
                    'status' => ResponseInterface::HTTP_OK,
                    'message' => 'Akun berhasil dibuat, silahkan cek email untuk aktivasi akun',
                    'csrf' => [
                        'name' => csrf_token(),
                        'value' => csrf_hash(),
                    ]
                ];
            }else{
                $deleteUser = $this->userModel->where('user_email', $data['user_email'])->where('is_active', 0)->delete();
                return [
                    'status' => ResponseInterface::HTTP_BAD_REQUEST,
                    'message' => 'Akun berhasil dibuat, silahkan cek email untuk aktivasi akun',
                    'message' => 'Emai gagal dikirimi, silahkan coba lagi',
                    'csrf' => [
                        'name' => csrf_token(),
                        'value' => csrf_hash(),
                    ]
                ];
            }
        }
    }
}
