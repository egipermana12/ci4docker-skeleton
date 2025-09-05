<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RuteTenants extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'rute_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tenant_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'kota_asal_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'kota_tujuan_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'durasi_perjalanan_minutes' => [
                'type'           => 'INT',
            ],
        ]);
        $this->forge->addKey('rute_id', true);
        $this->forge->addForeignKey('tenant_id', 'tenants', 'tenant_id');
        $this->forge->addForeignKey('kota_asal_id', 'tenants_city', 'city_id');
        $this->forge->addForeignKey('kota_tujuan_id', 'tenants_city', 'city_id');
        $this->forge->createTable('tenants_rute');
    }

    public function down()
    {
        $this->forge->dropTable('tenants_rute');
    }
}
