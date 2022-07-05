<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_ROLE' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'DESIGNATION_ROLE' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'tenant', 'client'],
                'comment' => 'Role des utilisateurs',
            ],
            'ETAT_ROLE' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ]
        ]);
        $this->forge->addPrimaryKey('ID_ROLE');
        $this->forge->createTable('roles');
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}
