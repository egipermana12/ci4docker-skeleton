<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User;
use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Google;

class AuthSosmed extends BaseController
{
    public function facebook()
    {
        $provider = new Facebook([
            'clientId'          => getenv('FB_APP_ID'),
            'clientSecret'      => getenv('FB_APP_SECRET'),
            'redirectUri'       => getenv('FB_REDIRECT_URI'),
            'graphApiVersion'   => 'v2.10',
        ]);

        //get authorization url
        $authUrl = $provider->getAuthorizationUrl([
            'scope' => ['email'], //minta izin email
        ]);

        //simpan session state
        session()->set('oauth2state', $provider->getState());

        //redirect ke url authorization
        return redirect()->to($authUrl);
    }

    public function facebookCallback()
    {
        $provider = new Facebook([
            'clientId'          => getenv('FB_APP_ID'),
            'clientSecret'      => getenv('FB_APP_SECRET'),
            'redirectUri'       => getenv('FB_REDIRECT_URI'),
            'graphApiVersion'   => 'v2.10',
        ]);

        //validasi state
        $state = $this->request->getGet('state');

        if (empty($state) || ($state !== session()->get('oauth2state'))) {
            session()->remove('oauth2state');
            return redirect()->to('/login')->with('error', 'Invalid OAuth Facebook state');
        }

        try {
            //ambil token
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $this->request->getGet('code'),
            ]);

            //ambil data user
            $userFb = $provider->getResourceOwner($token);
            var_dump($userFb);
            die;


            //simpan data user ke database
            // $userModel = new User();
            // $user = $userModel->where('email', $userFb->getEmail())->first();

        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Login dengan Facebook gagal: ' . $e->getMessage());
        }
    }

    public function google()
    {
        $provider = new Google([
            'clientId'          => getenv('GOOGLE_CLIENT_ID'),
            'clientSecret'      => getenv('GOOGlE_CLIENT_SECRET'),
            'redirectUri'       => getenv('GOOGLE_REDIRECT_URI'),
        ]);

        //get authorization url
        $authUrl = $provider->getAuthorizationUrl();

        session()->set('oauth2stategoogle', $provider->getState());

        //redirect ke url authorization
        return redirect()->to($authUrl);
    }

    public function googleCallback()
    {
        $provider = new Google([
            'clientId'          => getenv('GOOGLE_CLIENT_ID'),
            'clientSecret'      => getenv('GOOGlE_CLIENT_SECRET'),
            'redirectUri'       => getenv('GOOGLE_REDIRECT_URI'),
        ]);

        //validasi state
        $state = $this->request->getGet('state');
        if (empty($state) || ($state !== session()->get('oauth2stategoogle'))) {
            session()->remove('oauth2stategoogle');
            return redirect()->to('/login')->with('error', 'Invalid OAuth Google state');
        }

        try {
            //ambil token
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $this->request->getGet('code'),
            ]);

            //ambil data user
            $userGoogle = $provider->getResourceOwner($token);
            $email = $userGoogle->getEmail();

            $userModel = new User();
            $user = $userModel->where('user_email', $email)->first();

            if (!$user) {
                //simpan data user ke database
                $userModel->insert([
                    'user_email' => $email,
                    'password' => '',
                    'user_name' => $userGoogle->getName(),
                    'role' => 'user',
                    'is_active' => 1,
                    'provider' => 'google',
                    'provider_id' => $userGoogle->getId(),
                ]);
                $user = $userModel->where('user_email', $email)->first();
            }

            //set session
            session()->set('user_id', $user['user_id']);

            return redirect()->to('/dashboard');
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Login dengan Google gagal: ' . $e->getMessage());
        }
    }
}
