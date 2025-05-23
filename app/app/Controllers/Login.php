<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\BladeRenderer;
use App\Models\User;

class Login extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $blade = new BladeRenderer();
        $data = [
            'title' => 'Login',
            'message' => 'Welcome to CodeIgniter 4!',
        ];
        return $blade->render('login/login', $data);
    }

    /**
     * fungsi login
     * * */
    public function login()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'user_email' => 'required|valid_email',
                'password' => 'required',
            ];
            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => ResponseInterface::HTTP_BAD_REQUEST,
                    'message' => $this->validator->getErrors(),
                ]);
            } else {
                $data = [
                    'user_email' => $this->request->getPost('user_email'),
                    'password' => $this->request->getPost('password'),
                    'remember' => $this->request->getPost('remember'),
                ];
                $user = $this->user->where('user_email', $data['user_email'])->first();
                if ($user && password_verify($data['password'], $user['password'])) {
                    //cek apakah akun sudah diaktifkan
                    if ($user['is_active'] != 1) {
                        return $this->response->setJSON([
                            'status' => ResponseInterface::HTTP_BAD_REQUEST,
                            'message' => 'Akun belum diaktifkan',
                        ]);
                    }
                    //set session
                    session()->set('user_id', $user['user_id']);

                    //cek apakah user memilih remember me
                    if ($data['remember']) {
                        $token = bin2hex(random_bytes(32));
                        $this->user->where('user_id', $user['user_id'])->set(['remember_token' => hash('sha256', $token)])->update();
                        $cookieRemember = [
                            'name' => 'remember_me',
                            'value' => $token,
                            'expire' => time() + 60 * 60 * 24 * 30, //30 hari
                            'httponly' => true,
                        ];
                        set_cookie($cookieRemember);
                    }
                    return $this->response->setJSON([
                        'status' => ResponseInterface::HTTP_OK,
                        'message' => 'Login berhasil',
                        'redirect' => base_url('dashboard'),
                    ]);
                }
                return $this->response->setJSON([
                    'status' => ResponseInterface::HTTP_BAD_REQUEST,
                    'message' => 'Email atau password salah',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => 'Invalid request',
            ]);
        }
    }
}
