<?php

namespace App\Controllers;

use App\Libraries\BladeRenderer;
use App\Models\User;
use App\Models\Tenants;

class Home extends BaseController
{
    protected $user;
    protected $tenants;

    public function __construct()
    {
        $this->user = new User();
        $this->tenants = new Tenants();
    }

    public function index(): string
    {
        $blade = new BladeRenderer();

        $activeTenant = session()->get('activeTenantSubDomain');
        if ($activeTenant) {
            return $blade->render('tenantspage/index');
        }


        return $blade->render('index');
    }

    public function dashboard(): string
    {
        $findTenant = $this->tenants->where('user_id', session()->get('user_id'))->first();

        $blade = new BladeRenderer();
        if ($findTenant) {
            return $blade->render('dashboard/tenant_not_null', ['tenant' => $findTenant]);
        } else {
            return $blade->render('dashboard/tenant_null', ['tenant' => null]);
        }
    }
}
