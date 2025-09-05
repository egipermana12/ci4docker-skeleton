<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TenantDepartureController extends BaseController
{
    public function index()
    {
        echo 'Hello';
    }

    public function findTujuan()
    {
        $id_kota_berangkat = $this->request->getPost('city_id');
        return $this->response->setJSON([
            'status' => ResponseInterface::HTTP_OK,
            'message' => 'Login berhasil',
            'id' => $id_kota_berangkat,
        ]);
    }
}
