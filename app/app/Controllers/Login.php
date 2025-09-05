<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\BladeRenderer;
use App\Services\AuthServices;
use App\Validation\ValidasiAuth;

class Login extends BaseController
{
    protected $authServices;
    protected $validasiAuth;

    public function __construct()
    {
        $this->authServices = new AuthServices();
        $this->validasiAuth = new ValidasiAuth();
    }

    public function index()
    {
        $has_login = session()->has('user_id');
        if ($has_login)
        {
            return redirect()->to(base_url('dashboard'));
        }

        $blade = new BladeRenderer();
        $data = [
            'title' => 'Login',
            'message' => 'Welcome to CodeIgniter 4!',
        ];
        return $blade->render('Authentication/login', $data);
    }

    /**
     * fungsi login
     * * */
    public function login()
    {
        //return if not ajax request
        if (!$this->request->isAJAX())
        {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => 'Invalid request',
            ]);
        }

        //handle validasi login
        $validator_login = $this->validasiAuth->loginValidation();

        if(!$this->validate($validator_login))
        {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => $this->validator->getErrors(),
                'redirect' => null,
                'csrf' => [
                    'name' => csrf_token(),
                    'value' => csrf_hash(),
                ]
            ]);
        }

        //credetials
        $credentials = $this->request->getPost(['user_email', 'password', 'remember']);
        $result = $this->authServices->login($credentials);

        //return response
        return $this->response->setJSON([
            'status' => $result['status'] ? ResponseInterface::HTTP_OK : ResponseInterface::HTTP_BAD_REQUEST,
            'message' => $result['message'],
            'redirect' => $result['status'] ? $result['redirect'] : null,
            'csrf' => [
                'name' => csrf_token(),
                'value' => csrf_hash(),
            ]
        ]);
    }

    public function logout()
    {
        $logout = $this->authServices->logout();
        if($logout) {
            return redirect()->to(base_url('login'));
        }
    }
}
