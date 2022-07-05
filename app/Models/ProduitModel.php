<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produits';
    protected $primaryKey       = 'ID_PRODUIT';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['REF_BOUTIQUE_PRODUIT', 'DESIGNATION_PRODUIT', 'PU_PRODUIT', 'QUANTITE_PRODUIT', 'MARGE_PRODUIT', 'IMAGE_PRODUIT', 'DATE_ENR_PRODUIT', 'ETAT_PRODUIT'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    //== Fonction pour enregistrer un produit ===========
    public function save_produit($produit)
    {
        $model = new ProduitModel();
        $save = $model->insert($produit);
        return $save;
    }

    //== Function pour recuperer tous les produits
    public function get_all()
    {
        $builder = $this->db->table('produits');
        $builder->select('*');
        $builder->where('ETAT_PRODUIT >=', 1);
        $query = $builder->get();
        return $query->getResultArray();
    }

    //== Function pour recuperer les produits d'une boutique
    public function get_by_store($id_store)
    {
        $builder = $this->db->table('produits');
        $builder->select('*');
        $builder->where('ETAT_PRODUIT >=', 1);
        $builder->where('REF_BOUTIQUE_PRODUIT', $id_store);
        $query = $builder->get();
        return $query->getResult();
    }

    //== recuperer les produits de toutes les boutiques de l'utilisateur
    public function get_by_user($id_user)
    {
        $builder = $this->db->table('produits');
        $builder->select('*');
        $builder->where('ETAT_PRODUIT >=', 1);
        $builder->where('user_boutique.REF_USER', $id_user);
        $builder->join('boutiques', 'boutiques.ID_BOUTIQUE = produits.REF_BOUTIQUE_PRODUIT');
        $builder->join('user_boutique', 'user_boutique.REF_BOUTIQUE = boutiques.ID_BOUTIQUE');
        $query = $builder->get();
        return $query->getResult();
    }

    //== recuperer les produits d'un panier
    public function get_by_panier($id_user, $id_panier)
    {
        $builder = $this->db->table('produits');
        $builder->select('*');
        $builder->where('ETAT_PRODUIT >=', 1);
        $builder->where('panier_produit.REF_PANIER', $id_panier);
        $builder->where('paniers.REF_USER_PANIER', $id_user);
        $builder->join('panier_produit', 'panier_produit.REF_PRODUIT = produits.ID_PRODUIT');
        $builder->join('paniers', 'paniers.ID_PANIER = panier_produit.REF_PANIER');
        $query = $builder->get();
        return $query->getResult();
    }

    //== fonction  pour compter les produit d'une boutique
    public function get_count($id_store)
    {
        $builder = $this->db->table('produits');
        $builder->select('*');
        $builder->where('ETAT_PRODUIT >=',1);
        $builder->where('REF_BOUTIQUE_PRODUIT =',$id_store);
        return $count = $builder->countAllResults();
    }

    public function get_one($id)
    {
        $model = new ProduitModel();
        $produit = $model->find($id);
        return $produit;
    }
}
