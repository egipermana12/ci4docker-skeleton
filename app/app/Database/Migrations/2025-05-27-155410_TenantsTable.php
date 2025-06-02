<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TenantsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tenant_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'tenant_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Tenant Name Travel',
            ],
            'tenant_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Tenant Email',
            ],
            'subdomain' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'subdomain',
            ],
            'tenant_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Tenant Address',
            ],
            'tenant_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'comment'    => 'Tenant Phone',
            ],
            'tenant_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => 'Tenant Logo',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ],
        ]);
        $this->forge->addKey('tenant_id', true);
        $this->forge->addUniqueKey('subdomain');
        $this->forge->addForeignKey('user_id', 'users', 'user_id');
        $this->forge->createTable('tenants');
    }

    public function down()
    {
        $this->forge->dropTable('tenants');
    }
}
