<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PanierModel;
use App\Models\ProduitModel;
use App\Models\PanierProduitModel;

class PanierController extends BaseController
{
    public function index()
    { 
        //
    }

    // Liste des panier d'un client dans une boutique
    public function panier_client($id_store)
    {
        $current_user = session()->get('id');
        $data = [];
        $panierModel = new PanierModel();
        $data['paniers'] = $panierModel->get_by_user($current_user, $id_store);

        return view('client/panier_client_list', $data);

    }

    //== Voir les details et modifier un panier
    public function panier_detail($id_store,$id_panier)
    {
        $current_user = session()->get('id');
        $data = [];
        $produitModel = new ProduitModel();
        $panierModel = new PanierModel();

        if($this->request->getPost())
        {
            $rules = [
                'designation' => 'required|min_length[3]|max_length[50]',
                'id_produit' => 'required',
                'pu_produit' => 'required',
                'qu_produit' => 'required',
            ];
            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else{
                $panier = [
                    'DESIGNATION_PANIER' => $this->request->getVar('designation'),
                ];

                $save_panier = $panierModel->update($id_panier,$panier);
                $panierProduitModel = new PanierProduitModel();

                for($i = 0; $i < count($this->request->getVar('id_produit')); $i++)
                {
                    $id_produit = $this->request->getVar('id_produit')[$i];
                    
                    $pu_produit = $this->request->getVar('pu_produit')[$i];
                    $qu_produit = $this->request->getVar('qu_produit')[$i];
                    $tot_produit = $this->request->getVar('qu_produit')[$i] * $this->request->getVar('pu_produit')[$i];

                    $save_panier_produit = $panierProduitModel->update_produit($id_panier,$id_produit,$pu_produit,$qu_produit,$tot_produit);
                }

                if(!$save_panier_produit){
                    $data['success'] = "Panier modifier";
                }else{
                    $data['error'] = "Panier non modifier";
                }

            }
        }

        $data['panier'] = $panierModel->get_one($id_panier);
        $data['produits'] = $produitModel->get_by_panier($current_user, $id_panier);

        return view('client/panier_detail', $data);
    }

    //== Supprimer un produit du panier
    public function panier_delete_produit($id_store,$id_panier,$id_produit)
    {
        $session = session();
        $panierProduitModel = new PanierProduitmodel();
        $delete = $panierProduitModel->delete_produit($id_panier, $id_produit);
        if($delete){
            $session->setFlashdata('success', 'Produit retiré du panier');
            return redirect()->to('client/panier_detail/'.$id_store.'/'.$id_panier);
        }else{
            $session->setFlashdata('error', 'Produit non retiré du panier');
            return redirect()->to('client/panier_detail/'.$id_store.'/'.$id_panier);
        }
    }

    //== Valider un panier
    public function valider_panier($id_store,$id_panier)
    {
        $panierModel = new PanierModel();
        $session = session();
        $valider = $panierModel->validate_panier($id_panier);
        if($valider){
            $session->setFlashdata('success', 'Panier validé');
            return redirect()->to('client/panier_detail/'.$id_store.'/'.$id_panier);
        }else{
            $session->setFlashdata('error', 'Panier non validé');
            return redirect()->to('client/panier_detail/'.$id_store.'/'.$id_panier);
        }
    }

    // Liste des panier d'un client
    public function panier()
    {
        $current_user = session()->get('id');
        $panierModel = new PanierModel();
        $data = [];

        $data['paniers'] = $panierModel->getAll_by_user($current_user);

        return view('client/paniers', $data);

    }
}
