<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduitModel;

class ProduitController extends BaseController
{
    //Liste des produits
    public function index()
    {
        $data = [];
        $produitModel = new ProduitModel();
        
        $data=[];
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        $data['perPage'] = 10;
        $data['total'] = $produitModel->where('ETAT_PRODUIT >=', 1)->countAll();
        $data['produits'] = $produitModel->where('ETAT_PRODUIT >=', 1)->paginate($data['perPage']);
        $data['pager'] = $produitModel->pager;
        
       
        echo view('tenant/produit_list', $data);
    }

    //== Function pour ajouter un nouveau produit
    public function produit_add($id)
    {
        helper(['form']);

        if($this->request->getPost())
        {
            $rules = [
                'designation' => 'required|min_length[3]|max_length[50]',
                'pu' => 'required|max_length[50]',
                'quantite' => 'required|max_length[50]',
                'marge' => 'required|max_length[50]',
                'image_produit' => "uploaded[image_produit]|max_size[image_produit,2048]|is_image[image_produit]|mime_in[image_produit,image/jpg,image/jpeg,image/png]",
            ];

            $session = session();

            if(!$this->validate($rules))
            {
                $data = $this->validator;
                $session->setFlashdata('validation', $data->listErrors());
            }else{
                $image = $this->request->getFile('image_produit');
                $image->move('uploads/produits');

                $produit = [
                    'REF_BOUTIQUE_PRODUIT' => $this->request->getVar('id'),
                    'DESIGNATION_PRODUIT' => $this->request->getVar('designation'),
                    'PU_PRODUIT' => $this->request->getVar('pu'),
                    'QUANTITE_PRODUIT' => $this->request->getVar('quantite'),
                    'MARGE_PRODUIT' => $this->request->getVar('marge'),
                    'IMAGE_PRODUIT' => 'uploads/produits/'.$image->getClientName()
                ];

                $produitModel = new ProduitModel();
                $save = $produitModel->insert($produit);

                if($save) {
                    $session->setFlashdata('success', "Produit enregistré");
                }else{
                    $session->setFlashdata('error', "Produit non enregistré");
                }
            }
        }
        return redirect()->to('/tenant/boutique_view/'.$id.'');
    }

    // Detail et modification d'un produit
    public function produit_edit($store, $id_produit)
    {
        $data = [];
        $produitModel = new ProduitModel();

        if($this->request->getPost())
        {
            $rules = [
                'designation' => 'required|min_length[3]|max_length[50]',
                'pu' => 'required|max_length[50]',
                'quantite' => 'required|max_length[50]',
                'marge' => 'required|max_length[50]',
                // 'image_produit' => "uploaded[image_produit]|max_size[image_produit,2048]|is_image[image_produit]|mime_in[image_produit,image/jpg,image/jpeg,image/png]",
            ];

            $session = session();

            if(!$this->validate($rules))
            {
                $data_validation = $this->validator;
                $session->setFlashdata('validation', $data_validation->listErrors());
            }else{
                $produit = [];

                if(!$this->request->getFile('image_produit')) {
                    $image = $this->request->getFile('image_produit');
                    $image->move('uploads/produits');

                    $produit = [
                        'DESIGNATION_PRODUIT' => $this->request->getVar('designation'),
                        'PU_PRODUIT' => $this->request->getVar('pu'),
                        'QUANTITE_PRODUIT' => $this->request->getVar('quantite'),
                        'MARGE_PRODUIT' => $this->request->getVar('marge'),
                        'IMAGE_PRODUIT' => 'uploads/produits'.$image->getClientName()
                    ];
                }else{
                    $produit = [
                        'DESIGNATION_PRODUIT' => $this->request->getVar('designation'),
                        'PU_PRODUIT' => $this->request->getVar('pu'),
                        'QUANTITE_PRODUIT' => $this->request->getVar('quantite'),
                        'MARGE_PRODUIT' => $this->request->getVar('marge'),
                    ];
                }
                

                $produitModel = new ProduitModel();
                $save = $produitModel->update($id_produit, $produit);

                if($save) {
                    return redirect()->to('/tenant/boutique_view/'.$store);
                }else{
                    $session->setFlashdata('error', "Produit non enregistré");
                }
            }
        }

        $data['produit'] = $produitModel->find($id_produit);

        return view('tenant/produit_edit', $data);
    }

    // Activer et desactiver un produit
    public function produit_active($store, $id)
    {
        $state = null;
        $produitModel = new ProduitModel();
        $produit = $produitModel->find($id);

        if($produit['ETAT_PRODUIT'] == 1) {
            $state = 2;
        }
        if($produit['ETAT_PRODUIT'] == 2) {
            $state = 1;
        }
        $data = ['ETAT_PRODUIT' => $state];

        $active = $produitModel->update($id, $data);

        return redirect()->to('/tenant/boutique_view/'.$store);
    }

    // Suppression d'un produit
    public function produit_delete($store, $id)
    {
        $produitModel = new ProduitModel();
        $data = ['ETAT_PRODUIT' => 0];
        $active = $produitModel->update($id, $data);

        return redirect()->to('/tenant/boutique_view/'.$store);
    }
}
