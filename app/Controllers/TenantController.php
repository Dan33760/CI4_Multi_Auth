<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduitModel;
use App\Models\UserModel;
use App\Models\UserBoutiqueModel;
use App\Models\BoutiqueModel;


class TenantController extends BaseController
{
    // liste des boutiques d'un tenant
    public function index()
    {
        $boutiqueModel = new BoutiqueModel();
        $current_user = session()->get('id');

        $data['count_boutique'] = $boutiqueModel->count_by_user($current_user);

        return view('tenant/dashboard', $data);
    }

    public function client()
    {
        echo view('tenant/client_list');
    }
}
