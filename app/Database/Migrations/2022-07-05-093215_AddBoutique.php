<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBoutique extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_BOUTIQUE' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'DESIGNATION_BOUTIQUE' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'comment' => 'Designation boutique'
            ],
            'DESCRIPTION_BOUTIQUE' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'comment' => 'Description boutique'
            ],
            'ETAT_BOUTIQUE' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '0: Supprimer, 1: Actif, 2: Non actif'
            ],
            'DATE_ENR_BOUTIQUE datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('ID_BOUTIQUE');
        $this->forge->createTable('boutiques');
        
    }

    public function down()
    {
        $this->forge->dropTable('boutiques');
    }
}
