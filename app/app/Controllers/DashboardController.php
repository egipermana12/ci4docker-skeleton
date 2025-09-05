<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\BladeRenderer;
use App\Models\User;
use App\Models\Tenants;

class DashboardController extends BaseController
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
        $findTenant = $this->tenants
            ->where('user_id', session()->get('user_id'))
            ->first();

        $blade = new BladeRenderer();
        if ($findTenant) {
            return $blade->render('dashboard/tenant_not_null', [
                'tenant' => $findTenant,
            ]);
        } else {
            return $blade->render('dashboard/tenant_null', ['tenant' => null]);
        }
    }
}
