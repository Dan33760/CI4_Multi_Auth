<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPanierProduit extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'REF_PANIER' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Id reference panier'
            ],
            'REF_PRODUIT' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Id reference produit'
            ],
            'PU_PANIER' => [
                'type' => 'DECIMAL',
                'constraint' => 10,2,
                'null' => false,
                'comment' => 'Prix unitaire'
            ],
            'QUANTITE_PRODUIT_PANIER' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'comment' => 'Quantite dans le panier'
            ],
            'PT_PANIER' => [
                'type' => 'DECIMAL',
                'constraint' => 10,2,
                'null' => false,
                'comment' => 'Prix total du panier'
            ]
        ]);
        $this->forge->addKey(['REF_PANIER', 'REF_PRODUIT']);
        $this->forge->addForeignKey('REF_PANIER', 'paniers', 'ID_PANIER');
        $this->forge->addForeignKey('REF_PRODUIT', 'produits', 'ID_PRODUIT');
        $this->forge->createTable('panier_produit');
        
    }

    public function down()
    {
        $this->forge->dropTable('panier_produit');
    }
}
