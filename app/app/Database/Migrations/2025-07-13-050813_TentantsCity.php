<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TentantsCity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'city_id' => [
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
            'city_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Nama Kota',
            ],
        ]);
        $this->forge->addKey('city_id', true);
        $this->forge->addForeignKey('tenant_id', 'tenants', 'tenant_id');
        $this->forge->createTable('tenants_city');
    }

    public function down()
    {
        $this->forge->dropTable('tenants_city');
    }
}
