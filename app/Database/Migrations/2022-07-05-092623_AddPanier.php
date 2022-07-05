<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPanier extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_PANIER' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'REF_USER_PANIER' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Id reference utilisateur'
            ],
            'DESIGNATION_PANIER' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'comment' => 'Designation panier'
            ],
            'ETAT_PANIER' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '0: Supprimer, 1: Actif, 2: Non actif'
            ],
            'DATE_ENR_PANIER datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('ID_PANIER');
        $this->forge->addForeignKey('REF_USER_PANIER', 'users', 'ID_USER');
        $this->forge->createTable('paniers');
        
    }

    public function down()
    {
        $this->forge->dropTable('paniers');
    }
}
