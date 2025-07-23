<?php

namespace App\Services;

use App\Models\Tenants;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Files\UploadedFile;

class TenantService
{
    protected $tenantModel;

    public function __construct()
    {
        $this->tenantModel = new Tenants();
    }

    /**
     * Handle fetch tenant
     *
     * @return array
     */
    public function fetch()
    {
        $db = db_connect();
        $builder = $db
            ->table('tenants')
            ->select(
                'tenant_name, tenant_email, subdomain, tenant_logo, tenant_address, tenant_phone',
            );
        return $builder;
    }

    /**
     * Handle insert tenant
     *
     * @param array $requestData
     * @param UploadedFile $tenantLogo
     * @return array
     */

    public function store(array $tenantText, UploadedFile $tenantLogo): array
    {
        //handle image
        $imageName = $tenantLogo->getRandomName();
        $tenantLogo->move('tenant_logo', $imageName);

        $data = [
            'user_id' => session()->get('user_id'),
            'tenant_name' => $tenantText['tenant_name'],
            'tenant_email' => $tenantText['tenant_email'],
            'subdomain' => $tenantText['subdomain'],
            'tenant_logo' => $tenantLogo->getName(),
            'tenant_address' => $tenantText['tenant_address'],
            'tenant_phone' => $tenantText['tenant_phone'],
        ];

        $insert = $this->tenantModel->insert($data);
        if ($insert) {
            return [
                'status' => ResponseInterface::HTTP_OK,
                'message' => 'Tenant Created',
            ];
        } else {
            return [
                'status' => ResponseInterface::HTTP_BAD_REQUEST,
                'message' => 'Tenant Fail Creat',
            ];
        }
    }
}
