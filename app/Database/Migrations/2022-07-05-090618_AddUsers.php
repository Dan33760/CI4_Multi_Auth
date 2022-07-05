<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_USER' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'REF_ROLE_USER' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Id reference role'
            ],
            'NOM_USER' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'comment' => 'Utilisateur'
            ],
            'POSTNOM_USER' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'comment' => 'Post nom utilisateur'
            ],
            'EMAIL_USER' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'unique' => true,
                'comment' => 'Adresse mail'
            ],
            'MDP_USER' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'comment' => 'Mot de passe utilisateur'
            ],
            'IMAGE_USER' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => 'Photo de profil'
            ],
            'ETAT_USER' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '0: Supprimer, 1: Actif, 2: Non actif'
            ],
            'DATE_ENR_USER datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('ID_USER');
        $this->forge->addForeignKey('REF_ROLE_USER', 'roles', 'ID_ROLE');
        $this->forge->createTable('users');
        
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
