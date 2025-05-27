<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\BladeRenderer;
use App\Models\User;
use App\Models\UserToken;

class Register extends BaseController
{
    protected $user;
    protected $userToken;
    public function __construct()
    {
        $this->user = new User();
        $this->userToken = new UserToken();
    }
    public function index()
    {
        $has_login = session()->has('user_id');
        if ($has_login) {
            return redirect()->to(base_url('dashboard'));
        }
        $blade = new BladeRenderer();
        $data = [
            'title' => 'Login',
            'message' => 'Welcome to CodeIgniter 4!',
        ];
        return $blade->render('login/register', $data);
    }

    public function register()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'user_name' => 'required|min_length[3]|max_length[20]|alpha_numeric_space|is_unique[users.user_name]',
                'user_email' => 'required|valid_email|is_unique[users.user_email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]',
            ];
            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => ResponseInterface::HTTP_BAD_REQUEST,
                    'message' => $this->validator->getErrors(),
                    'csrf' => [
                        'name' => csrf_token(),
                        'value' => csrf_hash(),
                    ]
                ]);
            } else {
                $email = $this->request->getVar('user_email');
                $data = [
                    'user_name' => $this->request->getVar('user_name'),
                    'user_email' => $this->request->getVar('user_email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'user_role' => 'user',
                    'is_active' => 0,
                ];
                $user = $this->user->insert($data);
                if ($user) {
                    $token = bin2hex(random_bytes(32));
                    $data = [
                        'email' => $this->request->getVar('user_email'),
                        'token' => $token,
                        'created_at' => date('Y-m-d H:i:s'),
                        'type' => 'activation'
                    ];
                    $this->userToken->insert($data);
                    $emailstatus = $this->_sendEmail($email, $token, 'activation');
                    if ($emailstatus) {
                        return $this->response->setJSON([
                            'status' => ResponseInterface::HTTP_OK,
                            'message' => 'Akun berhasil dibuat, silahkan cek email untuk aktivasi akun',
                        ]);
                    } else {
                        return $this->response->setJSON([
                            'status' => ResponseInterface::HTTP_BAD_REQUEST,
                            'message' => 'Emai gagal dikirimi, silahkan coba lagi',
                            'csrf' => [
                                'name' => csrf_token(),
                                'value' => csrf_hash(),
                            ]
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => ResponseInterface::HTTP_BAD_REQUEST,
                        'message' => 'Akun gagal dibuat',
                        'csrf' => [
                            'name' => csrf_token(),
                            'value' => csrf_hash(),
                        ]
                    ]);
                }
            }
        } else {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => 'Invalid request',
                'csrf' => [
                    'name' => csrf_token(),
                    'value' => csrf_hash(),
                ]
            ]);
        }
    }

    private function _sendEmail($toEmail, $token, $type)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($toEmail);
        $emailService->setFrom('no-reply@myapp.com', 'My App');
        if ($type == 'activation') {
            $emailService->setSubject('Aktivasi Akun');
            $emailService->setMessage('Klik link berikut untuk aktivasi akun: ' . base_url("auth/activate/$token"));
        } elseif ($type == 'reset') {
            $emailService->setSubject('Reset Password');
            $emailService->setMessage('Klik link berikut untuk reset password: ' . base_url("auth/reset-password-form/$token"));
        }

        $send = $emailService->send();
        if ($send) {
            return true;
        } else {
            return false;
        }
    }

    public function activate($token)
    {
        $userToken = $this->userToken->where('token', $token)->where('type', 'activation')->first();

        if ($userToken) {
            $this->user->where('user_email', $userToken['email'])->set(['is_active' => 1])->update();
            $this->userToken->delete($userToken['id']);
            return redirect()->to(base_url('login'))->with('success', 'Akun berhasil diaktifkan');
        }
        return redirect()->to('/login')->with('error', 'Token tidak valid!');
    }
}
