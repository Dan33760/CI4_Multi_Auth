<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BoutiqueModel;
use App\Models\UserBoutiqueModel;
use App\Models\ProduitModel;
use App\Models\PanierModel;
use App\Models\PanierProduitModel;
use App\Models\UserModel;

class ClientController extends BaseController
{
    public function index()
    {
        $current_user = session()->get('id');
        $data=[];
        $boutiqueModel = new BoutiqueModel();

        $data['boutiques'] = $boutiqueModel->get_all();

        return view('client/dashboard', $data);
    }

    //enregistrement d'un client par un tenant
    public function client_add($id_store)
    {
        helper(['helper']);

        if($this->request->getPost())
        {
            $rules = [
                'role' => 'required',
                'nom' => 'required|min_length[3]|max_length[50]',
                'postnom' => 'required|max_length[50]',
                'email' => 'required|min_length[3]|max_length[50]|valid_email',
                'mdp' => 'required|max_length[50]',
                // 'image_client' => "uploaded[image_client]|max_size[image_client,2048]|is_image[image_client]|mime_in[image_client,image/jpg,image/jpeg,image/png]",
            ];

            $session = session();

            if(!$this->validate($rules))
            {
                $data = $this->validator;
                $session->setFlashdata('validation', $data->listErrors());
            }else{
                // $image = $this->request->getFile('image_client');
                // $image->move('uploads/clients');

                $client = [
                    'REF_ROLE_USER' => $this->request->getVar('role'),
                    'NOM_USER' => $this->request->getVar('nom'),
                    'POSTNOM_USER' => $this->request->getVar('postnom'),
                    'EMAIL_USER' => $this->request->getVar('email'),
                    'MDP_USER' => $this->request->getVar('mdp'),
                    // 'IMAGE_USER' => 'uploads/clients/'.$image->getClientName()
                ];

                $clientModel = new UserModel();
                $user_boutique = new UserBoutiqueModel();

                $save = $clientModel->insert($client);

                $relation_U_B = [
                    'REF_BOUTIQUE' => $id_store,
                    'REF_USER' => $save
                ];
                $saveRelation = $user_boutique->save_u_b($relation_U_B);

                if($save) {
                    $session->setFlashdata('successs', "Client enregistré");
                }else{
                    $session->setFlashdata('errorr', "Client non enregistré");
                }
            }
        }
        return redirect()->to('/tenant/boutique_view/'.$id_store.'');
    }

    //== Activation et desactivation du compte client par un tenant
    public function client_active($store, $id)
    {
        $state = null;
        $clientModel = new UserModel();
        $client = $clientModel->find($id);

        if($client['ETAT_USER'] == 1) {
            $state = 2;
        }
        if($client['ETAT_USER'] == 2) {
            $state = 1;
        }
        $data = ['ETAT_USER' => $state];

        $active = $clientModel->update($id, $data);

        return redirect()->to('/tenant/boutique_view/'.$store);
    }

    //== Suppression d'un client par un tenant (softDelete)
    public function client_delete($store, $id)
    {
        $clientModel = new UserModel();
        $data = ['ETAT_USER' => 0];
        $active = $clientModel->update($id, $data);

        return redirect()->to('/tenant/boutique_view/'.$store);
    }

    //== Inscription d'un client a une boutique
    public function add_boutique($id_store)
    {
        $id_user = session()->get('id');
        $user_boutique = new UserBoutiqueModel();
        $session = session();

        $boutique = $user_boutique->get_by_user($id_user);

        foreach($boutique as $row)
        {
            if($row['REF_BOUTIQUE'] == $id_store){
                $session->setFlashdata('error', 'Vous etes membre de cette boutique');
                return redirect()->to('/client');
            }
        }

        $relation_U_B = [
            'REF_BOUTIQUE' => $id_store,
            'REF_USER' => $id_user
        ];

        $saveRelation = $user_boutique->save_u_b($relation_U_B);
        $session->setFlashdata('success', 'Inscription reussi');

        return redirect()->to('/client');
    }

    //== lister les produit d'une boutique
    public function view_produit($id_store)
    {
        $data = [];
        $produitModel = new ProduitModel();

        $data['produits'] = $produitModel->get_by_store($id_store);

        return view('client/produit_list', $data);

    }

    //== Liste des boutique d'un client
    public function boutique()
    {
        $current_user = session()->get('id');
        $data = [];
        $boutiqueModel = new BoutiqueModel();
        
        $data['boutiques'] = $boutiqueModel->get_by_user($current_user);

        return view('client/boutique_list', $data);
        
    }

    // Liste des produits et Ajout d'un panier
    public function view_produit_client($id_store)
    {
        $current_user = session()->get('id');
        $data = [];
        $produitModel = new Produitmodel();

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
                    'REF_USER_PANIER' => session()->get('id'),
                    'DESIGNATION_PANIER' => $this->request->getVar('designation'),
                ];

                $panierModel = new PanierModel();
                $save_panier = $panierModel->insert($panier);

                for($i = 0; $i < count($this->request->getVar('id_produit')); $i++)
                {
                    $panier_produit[] = [
                        'REF_PANIER' => $save_panier,
                        'REF_PRODUIT' => $this->request->getVar('id_produit')[$i],
                        'PU_PANIER' => $this->request->getVar('pu_produit')[$i],
                        'QUANTITE_PRODUIT_PANIER' => $this->request->getVar('qu_produit')[$i],
                        'PT_PANIER' => $this->request->getVar('qu_produit')[$i] * $this->request->getVar('pu_produit')[$i]
                    ];
                }

                $panierProduitModel = new PanierProduitModel();
                $save_panier_produit = $panierProduitModel->insertBatch($panier_produit);
                if($save_panier_produit){
                    $data['success'] = "Panier ajouter";
                }else{
                    $data['error'] = "Panier non enregistré";
                }

            }
        }

        $data['produits'] = $produitModel->get_by_store($id_store);

        return view('client/view_produit_list', $data);
    }
}
