<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TenantDepatrture extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'depature_id' => [
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
            'city_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'daparture_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Nama Kota',
            ],
        ]);
        $this->forge->addKey('depature_id', true);
        $this->forge->addForeignKey('tenant_id', 'tenants', 'tenant_id');
        $this->forge->addForeignKey('city_id', 'tenants_city', 'city_id');
        $this->forge->createTable('tenants_daparture');
    }

    public function down()
    {
        $this->forge->dropTable('tenants_daparture');
    }
}
