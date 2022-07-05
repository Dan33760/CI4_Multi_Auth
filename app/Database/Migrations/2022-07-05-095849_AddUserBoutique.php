<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserBoutique extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'REF_BOUTIQUE' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Id reference panier'
            ],
            'REF_USER' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Id reference produit'
            ]
        ]);
        $this->forge->addKey(['REF_BOUTIQUE', 'REF_USER']);
        $this->forge->addForeignKey('REF_BOUTIQUE', 'boutiques', 'ID_BOUTIQUE');
        $this->forge->addForeignKey('REF_USER', 'users', 'ID_USER');
        $this->forge->createTable('user_boutique');
        
    }

    public function down()
    {
        $this->forge->dropTable('user_boutique');
    }
}
