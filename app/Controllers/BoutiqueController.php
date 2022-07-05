<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BoutiqueModel;
use App\Models\UserBoutiqueModel;
use App\Models\ProduitModel;
use App\Models\RoleModel;
use App\Models\UserModel;

class BoutiqueController extends BaseController
{
    public function index()
    {
        $data = [];
        $boutiqueModel = new BoutiqueModel();
        $id_user = session()->get('id');

        if($this->request->getPost())
        {
            $rules = [
                'designation' => 'required|min_length[3]|max_length[50]',
                'description' => 'required|min_length[3]'
            ];

            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else{
                $boutiqueModel = new BoutiqueModel();
                $user_boutique = new UserBoutiqueModel();

                $boutique = [
                    'DESIGNATION_BOUTIQUE' => $this->request->getVar('designation'),
                    'DESCRIPTION_BOUTIQUE' => $this->request->getVar('description'),
                ];
                $saveBoutique = $boutiqueModel->save_boutique($boutique);

                $relation_U_B = [
                    'REF_BOUTIQUE' => $saveBoutique,
                    'REF_USER' => session()->get('id')
                ];
                $saveRelation = $user_boutique->save_u_b($relation_U_B);

                if(!$saveRelation){
                    $data['success'] = "Boutique ajouter";
                }else{
                    $data['error'] = "Boutique non enregistré";
                }
            }
        }
        $data['boutiques'] = $boutiqueModel->get_by_user($id_user);

        echo view('tenant/boutique_list', $data);
    }

    // Modifier une boutique
    public function boutique_edit($id)
    {
        $data = [];
        $boutiqueModel = new BoutiqueModel();

        if($this->request->getPost())
        {
            $rules = [
                'designation' => 'required|min_length[3]|max_length[50]',
                'description' => 'required|min_length[3]'
            ];

            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else{
                $boutiqueModel = new BoutiqueModel();

                $boutique = [
                    'DESIGNATION_BOUTIQUE' => $this->request->getVar('designation'),
                    'DESCRIPTION_BOUTIQUE' => $this->request->getVar('description'),
                ];
                $id = $this->request->getVar('id');
                $update = $boutiqueModel->update_boutique($id, $boutique);

                if($update){
                    return redirect()->to('/tenant/boutique');
                }else{
                    $data['error'] = "Données non modifiées";
                }
            }
        }

        $data['id'] = $id;
        $data['boutique'] = $boutiqueModel->get_one($id);

        echo view('tenant/boutique_edit', $data);

    }

    //== activer ou desactiver une boutique par un tenant
    public function boutique_active($id)
    {
        $this->active($id);

        return redirect()->to('/tenant/boutique');
    }

    //== activer ou desactiver une boutique par un tenant
    public function boutique_active_admin($id_tenant,$id_store)
    {
        $this->active($id_store);

        return redirect()->to('/admin/boutiques/'.$id_tenant);
    }

    //== Activation et desactivation d'une boutique 
    public function active($id)
    {
        $state = null;
        $boutiqueModel = new BoutiqueModel();
        $boutique = $boutiqueModel->get_one($id);

        if($boutique['ETAT_BOUTIQUE'] == 1) {
            $state = 2;
        }
        if($boutique['ETAT_BOUTIQUE'] == 2) {
            $state = 1;
        }
        $data = ['ETAT_BOUTIQUE' => $state];

        $active = $boutiqueModel->update_boutique($id, $data);
        return $active;
    }

    //== supprimer par le tenant
    public function boutique_delete($id)
    {
        $this->delete($id);

        return redirect()->to('/tenant/boutique');
    }

    //== Supprimer par un admin
    public function boutique_delete_admin($id_tenant,$id)
    {
        $this->delete($id);

        return redirect()->to('/admin/boutiques/'.$id_tenant);

    }

    //== fonction de Suppression une boutique
    public function delete($id)
    {
        $boutiqueModel = new BoutiqueModel();
        $data = ['ETAT_BOUTIQUE' => 0];
        $delete = $boutiqueModel->update_boutique($id, $data);
        return $delete;
    }

    // Details d'une boutique pour un tenant
    public function boutique_view($id)
    {
        $roleModel = new RoleModel;
        $produitModel = new ProduitModel();
        $userModel = new UserModel();

        $data = [];
        $data['id'] = $id;

        $data['roles'] = $roleModel->get_role();

        $data['produits'] = $produitModel->get_by_store($id);
        $data['count_produit'] = $produitModel->get_count($id);

        $data['clients'] = $userModel->get_by_store($id);
        $data['count_client'] = $userModel->count_client($id);

        return view('tenant/boutique_view', $data);
    }

    // Details d'une boutique pour l'admin
    public function boutique_view_admin($id_tenant,$id_store)
    {
        $roleModel = new RoleModel;
        $produitModel = new ProduitModel();
        $userModel = new UserModel();

        $data = [];
        $data['id'] = $id_store;

        $data['roles'] = $roleModel->get_role();

        $data['produits'] = $produitModel->get_by_store($id_store);
        $data['count_produit'] = $produitModel->get_count($id_store);

        $data['clients'] = $userModel->get_by_store($id_store);
        $data['count_client'] = $userModel->count_client($id_store);

        return view('admin/boutique_view',$data);
    }
}
