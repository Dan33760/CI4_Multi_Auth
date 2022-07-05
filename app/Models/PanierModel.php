<?php

namespace App\Models;

use CodeIgniter\Model;

class PanierModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'paniers';
    protected $primaryKey       = 'ID_PANIER';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['REF_USER_PANIER', 'DESIGNATION_PANIER', 'DATE_ENR_PANIER', 'ETAT_PANIER'];

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

    public function get_one($id_panier)
    {
        $model = new PanierModel();
        $panier = $model->where('ETAT_PANIER >=', 1)->find($id_panier);
        return $panier;
    }

    //== Recuperer les panier de l'utilisateur dans une boutique
    public function get_by_user($id_user, $id_store)
    {
        $builder = $this->db->table('paniers');
        $builder->select('ID_PANIER, REF_USER_PANIER, DESIGNATION_PANIER, DATE_ENR_PANIER, ETAT_PANIER, boutiques.ID_BOUTIQUE,
        boutiques.DESIGNATION_BOUTIQUE');
        $builder->where('paniers.REF_USER_PANIER', $id_user);
        $builder->where('boutiques.ID_BOUTIQUE', $id_store);
        $builder->groupBy('panier_produit.REF_PANIER');
        $builder->groupBy('produits.REF_BOUTIQUE_PRODUIT');
        $builder->join('panier_produit', 'panier_produit.REF_PANIER = paniers.ID_PANIER');
        $builder->join('produits', 'produits.ID_PRODUIT = panier_produit.REF_PRODUIT');
        $builder->join('boutiques', 'boutiques.ID_BOUTIQUE = produits.REF_BOUTIQUE_PRODUIT');
        $query = $builder->get();
        return $query->getResult();
    }

    //== Recuperer tous les panier de l'utilisateur
    public function getAll_by_user($id_user)
    { 
        $builder = $this->db->table('paniers');
        $builder->select('paniers.ID_PANIER,
                        paniers.REF_USER_PANIER,
                        paniers.DESIGNATION_PANIER,
                        paniers.DATE_ENR_PANIER,
                        paniers.ETAT_PANIER,
                        boutiques.ID_BOUTIQUE,
                        boutiques.DESIGNATION_BOUTIQUE');
        $builder->groupBy('panier_produit.REF_PANIER');
        $builder->where('paniers.REF_USER_PANIER', $id_user);
        $builder->join('panier_produit', 'panier_produit.REF_PANIER = paniers.ID_PANIER');
        $builder->join('produits', 'produits.ID_PRODUIT = panier_produit.REF_PRODUIT');
        $builder->join('boutiques', 'boutiques.ID_BOUTIQUE = produits.REF_BOUTIQUE_PRODUIT');
        $query = $builder->get();
        return $query->getResult();
    }


    //== Valider un panier
    public function validate_panier($id_panier)
    {
        $model = new PanierModel();
        $data = ['ETAT_PANIER' => 2];
        $valider = $model->update($id_panier,$data);
        return $valider;
    }

}
