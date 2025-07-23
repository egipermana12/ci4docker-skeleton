<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Tenants;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Libraries\BladeRenderer;
use App\Services\TenantService;

class TenantsController extends BaseController
{
    private $tenants;
    protected $tenantService;

    public function __construct()
    {
        $this->tenants = new Tenants();
        $this->tenantService = new TenantService();
    }
    public function index()
    {
        $blade = new BladeRenderer();
        return $blade->render('dashboard/tenants/index');
    }

    public function fetchData()
    {
        //return if not ajax request
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => 'Invalid request',
            ]);
        }

        $builder = $this->tenantService->fetch();

        return DataTable::of($builder)
            ->edit('tenant_logo', function ($row) {
                return '<img src="' .
                    base_url('tenant_logo/' . $row->tenant_logo) .
                    '" alt="' .
                    $row->tenant_logo .
                    '" class="img-thumbnail text-center" width="64" height="64">';
            })
            ->addNumbering()
            ->toJson();
    }

    public function create()
    {
        //return if not ajax request
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => 'Invalid request',
            ]);
        }

        //validation handle
        if(!$this->validate($this->validator_create()))
        {
            return $this->response->setJSON([
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => $this->validator->getErrors(),
                'csrf' => [
                    'name' => csrf_token(),
                    'value' => csrf_hash(),
                ]
            ]);
        }

        //ambil data
        $tenantLogo = $this->request->getFile('tenant_logo');
        $tenantText = $this->request->getPost(['tenant_name','tenant_email','subdomain','tenant_address','tenant_phone']);

        $result = $this->tenantService->store($tenantText, $tenantLogo);

        return $this->response->setJSON([
            'status' => $result['status'] ? ResponseInterface::HTTP_OK : ResponseInterface::HTTP_BAD_REQUEST,
            'message' => $result['message'],
            'csrf' => [
                'name' => csrf_token(),
                'value' => csrf_hash(),
            ]
        ]);
    }

    public function validator_create()
    {
        $rules = [
            'tenant_name' =>
                'required|min_length[3]|max_length[20]|alpha_numeric_space|is_unique[tenants.tenant_name]',
            'tenant_email' =>
                'required|valid_email|is_unique[tenants.tenant_email]',
            'subdomain' =>
                'required|min_length[3]|max_length[20]|alpha_numeric_space|is_unique[tenants.subdomain]',
            'tenant_logo' =>
                'uploaded[tenant_logo]|max_size[tenant_logo,1024]|is_image[tenant_logo]|mime_in[tenant_logo,image/jpg,image/jpeg,image/png]',
            'tenant_address' => 'required|min_length[3]',
            'tenant_phone' =>
                'required|min_length[3]|max_length[20]|alpha_numeric_space',
        ];
        return $rules;
    }
}
