<?php

namespace App\Models;

use CodeIgniter\Model;

class PanierProduitModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'panier_produit';
    protected $primaryKey       = ['REF_PANIER', 'REF_PRODUIT'];
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['REF_PANIER', 'REF_PRODUIT', 'PU_PANIER', 'QUANTITE_PRODUIT_PANIER', 'PT_PANIER'];

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

    // public function update_produit($id_panier,$id_produit,$data)
    // {
    //     $builder = $this->db->table('panier_produit');
    //     $builder->where('REF_PANIER', $id_panier);
    //     $builder->where('REF_PRODUIT', $id_produit);
    //     $builder->update(['REF_PANIER' => $id_panier], $data);
    // }

    public function update_produit($id_panier,$id_produit,$pu_produit,$qu_produit,$tot_produit)
    {
        $query = $this->db->query("UPDATE `panier_produit` 
                SET `PU_PANIER`= $pu_produit, `QUANTITE_PRODUIT_PANIER`= $qu_produit, `PT_PANIER`= $tot_produit
                WHERE `REF_PANIER`= $id_panier AND `REF_PRODUIT`= $id_produit");
       
    }

    public function delete_produit($id_panier, $id_produit)
    {
        $model = new PanierProduitModel();
        $delete = $model->where(['REF_PANIER'=>$id_panier, 'REF_PRODUIT'=>$id_produit])->delete();
        return $delete;
    }
}
