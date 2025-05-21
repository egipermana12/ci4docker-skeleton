<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersToken extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['reset', 'verify'],
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users_token');
    }

    public function down()
    {
        $this->forge->dropTable('users_token');
    }
}
