<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    //== Seed pour enregistrer l'admin par defaut
    public function run()
    {
        $user = new UserModel();

        $user->insert([
                "REF_ROLE_USER" => 1,
                "NOM_USER"      => "Patrice",
                "POSTNOM_USER"  => "PK",
                "EMAIL_USER"    => "pat@gmail.com",
                "MDP_USER"      => password_hash("123456", PASSWORD_DEFAULT),
                "IMAGE_USER"    => "pas d'image"
            ]);
    }
}
