<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'user_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
                'default'    => '0'
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ],
            'user_role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'user'],
                'default'    => 'user'
            ],
            'modul_administrasi' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1', '2'],
                'default'    => '0',
                'comment'    => '0=disable, 1=write, 2=read'
            ],
            'modul_master' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1', '2'],
                'default'    => '0',
                'comment'    => '0=disable, 1=write, 2=read'
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->addUniqueKey('user_email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
