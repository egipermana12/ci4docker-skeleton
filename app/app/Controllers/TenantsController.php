<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Tenants;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Libraries\BladeRenderer;

class TenantsController extends BaseController
{
    private $tenants;
    public function __construct()
    {
        $this->tenants = new Tenants();
    }
    public function index()
    {
        $blade = new BladeRenderer();
        return $blade->render('dashboard/tenants/index');
    }

    public function fetchData()
    {
        $db = db_connect();
        $builder = $db->table('tenants')->select('tenant_name, tenant_email, subdomain, tenant_logo, tenant_address, tenant_phone');
        return DataTable::of($builder)
            ->edit('tenant_logo', function ($row) {
                return '<img src="' . base_url('tenant_logo/' . $row->tenant_logo) . '" alt="' . $row->tenant_logo . '" class="img-thumbnail text-center" width="64" height="64">';
            })
            ->addNumbering()->toJson();
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'tenant_name' => 'required|min_length[3]|max_length[20]|alpha_numeric_space|is_unique[tenants.tenant_name]',
                'tenant_email' => 'required|valid_email|is_unique[tenants.tenant_email]',
                'subdomain' => 'required|min_length[3]|max_length[20]|alpha_numeric_space|is_unique[tenants.subdomain]',
                'tenant_logo' => 'uploaded[tenant_logo]|max_size[tenant_logo,1024]|is_image[tenant_logo]|mime_in[tenant_logo,image/jpg,image/jpeg,image/png]',
                'tenant_address' => 'required|min_length[3]',
                'tenant_phone' => 'required|min_length[3]|max_length[20]|alpha_numeric_space',
            ];
            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => ResponseInterface::HTTP_BAD_REQUEST,
                    'message' => 'Invalid request',
                    'csrf' => [
                        'name' => csrf_token(),
                        'value' => csrf_hash(),
                    ],
                    'errors' => $this->validator->getErrors(),
                ]);
            } else {
                $image = $this->request->getFile('tenant_logo');
                $name = $image->getRandomName();
                $image->move('tenant_logo', $name);

                $data = [
                    'user_id' => session()->get('user_id'),
                    'tenant_name' => $this->request->getVar('tenant_name'),
                    'tenant_email' => $this->request->getVar('tenant_email'),
                    'subdomain' => $this->request->getVar('subdomain'),
                    'tenant_logo' => $image->getName(),
                    'tenant_address' => $this->request->getVar('tenant_address'),
                    'tenant_phone' => $this->request->getVar('tenant_phone'),
                ];
                $insert = $this->tenants->insert($data);
                if ($insert) {
                    return $this->response->setJSON([
                        'status' => ResponseInterface::HTTP_CREATED,
                        'message' => 'Tenant created',
                        'csrf' => [
                            'name' => csrf_token(),
                            'value' => csrf_hash(),
                        ]
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => ResponseInterface::HTTP_BAD_REQUEST,
                        'message' => 'Tenant gagal dibuat',
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
}
