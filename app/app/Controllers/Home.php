<?php

namespace App\Controllers;

use App\Libraries\BladeRenderer;
use App\Models\User;
use App\Models\Tenants;
use App\Models\TenantDeparture;



class Home extends BaseController
{
    protected $user;
    protected $tenants;
    protected $tenantsDeparture;

    public function __construct()
    {
        $this->user = new User();
        $this->tenants = new Tenants();
        $this->tenantsDeparture = new TenantDeparture();
    }

    public function index(): string
    {
        $blade = new BladeRenderer();

        $activeTenant = session()->get('activeTenantSubDomain');

        if ($activeTenant) {
            $departure = $this->tenantsDeparture->getCityAndDeparture();
            return $blade->render('tenantspage/index', ['departure' => $departure]);

        }else{
            return $blade->render('index');
        }
    }
}
