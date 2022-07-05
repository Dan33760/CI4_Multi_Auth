<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\RoleModel;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role = new RoleModel();

        $role->insertBatch([
            [
                "DESIGNATION_ROLE" => "admin"
            ],
            [
                "DESIGNATION_ROLE" => "tenant"
            ],
            [
                "DESIGNATION_ROLE" => "client"
            ]
        ]);
    }
}
