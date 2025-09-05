<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\BladeRenderer;
use App\Models\User;
use App\Models\UserToken;
use App\Services\AuthServices;

class Register extends BaseController
{
    protected $user;
    protected $userToken;
    protected $authService;

    public function __construct()
    {
        $this->user = new User();
        $this->userToken = new UserToken();
        $this->authService = new AuthServices();
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
        return $blade->render('Authentication/register', $data);
    }

    public function register()
    {
        /**
         * return if req not ajax
         */
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => 'Invalid request',
                'csrf' => [
                    'name' => csrf_token(),
                    'value' => csrf_hash(),
                ],
            ]);
        }

        /**
         *validation handle
         */
        if (!$this->validate($this->validator_register())) {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => $this->validator->getErrors(),
                'csrf' => [
                    'name' => csrf_token(),
                    'value' => csrf_hash(),
                ],
            ]);
        }

        $registrations = $this->request->getPost([ 'password' ,'user_email', 'password', 'user_name']);
        $result = $this->authService->register($registrations);
        return $this->response->setJSON($result);
    }

    public function validator_register()
    {
        $rules = [
            'user_name' =>
                'required|min_length[3]|max_length[20]|alpha_numeric_space|is_unique[users.user_name]',
            'user_email' => 'required|valid_email|is_unique[users.user_email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];
        return $rules;
    }

    public function activate($token)
    {
        $userToken = $this->userToken
            ->where('token', $token)
            ->where('type', 'verify')
            ->first();

        if ($userToken) {
            $this->user
                ->where('user_email', $userToken['email'])
                ->set(['is_active' => 1])
                ->update();
            $this->userToken->delete($userToken['id']);
            return redirect()
                ->to(base_url('login'))
                ->with('success', 'Akun berhasil diaktifkan');
        }
        return redirect()->to('/login')->with('error', 'Token tidak valid!');
    }
}
