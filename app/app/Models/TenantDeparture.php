<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TenantCity;
use App\Models\Tenants;
use App\Models\RuteTenants;

class TenantDeparture extends Model
{
    protected $table = 'tenants_daparture';
    protected $primaryKey = 'depature_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getCityAndDeparture()
    {
        // Ambil tenant aktif
        $tenantSession = session()->get('activeTenantSubDomain');
        if (empty($tenantSession)) {
            return []; // atau lempar exception
        }

        // Jika session menyimpan array (mis. ['tenant_id'=>...]) sesuaikan di sini:
        $tenant_id = is_array($tenantSession) ? ($tenantSession['tenant_id'] ?? null) : $tenantSession;
        if (empty($tenant_id)) {
            return [];
        }

        $findCity = (new TenantCity())
            ->where('tenant_id', $tenant_id)
            ->findAll();

        $depature_m = new TenantDeparture();

        $grouped = [];
        foreach ($findCity as $city) {
            $depature = $depature_m
                ->where('tenant_id', $tenant_id)
                ->where('city_id', $city['city_id'])
                ->findAll();
            if (!empty($depature)) {
                $grouped[] = [
                    'city_id' => $city['city_id'],
                    'city_name' => $city['city_name'],
                    'depature' => $depature,
                ];
            }
        }

        return $grouped;
    }

    public function getRuteCityAndDeparture($kota_asal_id)
    {
        $kota_asal_id = (int) $kota_asal_id;

        // Ambil tenant aktif
        $tenantSession = session()->get('activeTenantSubDomain');
        if (empty($tenantSession)) {
            return []; // atau lempar exception
        }

        // Jika session menyimpan array (mis. ['tenant_id'=>...]) sesuaikan di sini:
        $tenant_id = is_array($tenantSession) ? ($tenantSession['tenant_id'] ?? null) : $tenantSession;
        if (empty($tenant_id)) {
            return [];
        }

        // --- Ambil daftar kota tujuan berdasarkan rute ---
        $ruteModel = new \App\Models\RuteTenants();
        $tujuanIds = $ruteModel
            ->select('kota_tujuan_id')
            ->where('tenant_id', $tenant_id)
            ->where('kota_asal_id', $kota_asal_id)
            ->findColumn('kota_tujuan_id'); // <-- penting: array 1D

        if (empty($tujuanIds)) {
            return [];
        }

        // --- Ambil data kota tujuan ---
        $cityModel = new \App\Models\TenantCity();
        $cities = $cityModel
            ->where('tenant_id', $tenant_id)
            ->whereIn('city_id', $tujuanIds)
            ->findAll();

        if (empty($cities)) {
            return [];
        }

        $departureModel = new \App\Models\TenantDeparture();
        $grouped = [];

        foreach ($cities as $city) {
            $departures = $departureModel
                ->where('tenant_id', $tenant_id)
                ->where('city_id', $city['city_id'])
                ->findAll();

            if (!empty($departures)) {
                $grouped[] = [
                    'city_id'    => $city['city_id'],
                    'city_name'  => $city['city_name'] ?? null,
                    'departure'  => $departures,
                ];
            }
        }

        return $grouped;
    }
}
