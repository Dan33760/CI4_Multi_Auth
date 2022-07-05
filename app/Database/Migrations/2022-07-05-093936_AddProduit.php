<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProduit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_PRODUIT' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'REF_BOUTIQUE_PRODUIT' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Id reference boutique'
            ],
            'DESIGNATION_PRODUIT' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'comment' => 'Produit'
            ],
            'PU_PRODUIT' => [
                'type' => 'DECIMAL',
                'constraint' => 10,2,
                'null' => false,
                'comment' => 'Prix unitaire'
            ],
            'QUANTITE_PRODUIT' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'comment' => 'Quantite dans le stock'
            ],
            'MARGE_PRODUIT' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'comment' => 'Quantite dans le stock'
            ],
            'IMAGE_PRODUIT' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => 'Photo du produit'
            ],
            'ETAT_PRODUIT' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '0: Supprimer, 1: Actif, 2: Non actif'
            ],
            'DATE_ENR_PRODUIT datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('ID_PRODUIT');
        $this->forge->addForeignKey('REF_BOUTIQUE_PRODUIT', 'boutiques', 'ID_BOUTIQUE');
        $this->forge->createTable('produits');
        
    }

    public function down()
    {
        $this->forge->dropTable('produits');
    }
}
