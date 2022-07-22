<?php

namespace App\Models;

use CodeIgniter\Model;

class BoutiqueModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'boutiques';
    protected $primaryKey       = 'ID_BOUTIQUE';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['DESIGNATION_BOUTIQUE', 'DESCRIPTION_BOUTIQUE', 'DATE_ENR_BOUTIQUE', 'ETAT_BOUTIQUE'];

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

    //== Fonction pour recuperer toutes les boutiques
    public function get_all()
    {
        $builder = $this->db->table('boutiques');
        $builder->select('*');
        $builder->where('ETAT_BOUTIQUE >=', 1);
        $query = $builder->get();
        return $query->getResult();
    }
    
    //== Fonction pour recuperer une boutique
    public function get_one($id)
    {
        $model = new BoutiqueModel();
        $boutique = $model->where('ETAT_BOUTIQUE >=', 1)->find($id);
        return $boutique;
    }

    //== recuperer toutes les boutique d'un client ===
    public function get_by_user($id_user, $user_role)
    {
        $role = "tenant";
        if($user_role == "client")
        {
            $role = $user_role;
        }
        $builder = $this->db->table('boutiques');
        $builder->select('*');
        $builder->where('ETAT_BOUTIQUE >=', 1);
        $builder->where('user_boutique.REF_USER', $id_user);
        $builder->where('roles.DESIGNATION_ROLE ', $role);
        $builder->join('user_boutique', 'user_boutique.REF_BOUTIQUE = boutiques.ID_BOUTIQUE');
        $builder->join('users', 'users.ID_USER = user_boutique.REF_USER');
        $builder->join('roles', 'roles.ID_ROLE = users.REF_ROLE_USER');
        $query = $builder->get();
        return $query->getResult();
    }

    //== recuperer toutes les boutique d'un client ===
    public function get_eccept_user($id_user)
    {
        $builder = $this->db->table('boutiques');
        $builder->select('*');
        $builder->where('ETAT_BOUTIQUE >=', 1);
        $builder->whereNotIn('user_boutique.REF_USER', [$id_user]);
        $builder->join('user_boutique', 'user_boutique.REF_BOUTIQUE = boutiques.ID_BOUTIQUE');
        $builder->join('users', 'users.ID_USER = user_boutique.REF_USER');
        $query = $builder->get();
        return $query->getResult();
    }

    //== Compter toutes les boutique d'un client ===
    public function count_by_user($id_user)
    {
        $builder = $this->db->table('boutiques');
        $builder->select('*');
        $builder->where('ETAT_BOUTIQUE >=', 1);
        $builder->where('user_boutique.REF_USER', $id_user);
        $builder->join('user_boutique', 'user_boutique.REF_BOUTIQUE = boutiques.ID_BOUTIQUE');
        $builder->join('users', 'users.ID_USER = user_boutique.REF_USER');
        $query = $builder->countAllResults();
        return $query;
    }

    //== enregistrer une boutique ===========
    public function save_boutique($boutique)
    {
        $model = new BoutiqueModel();
        $save = $model->insert($boutique);
        return $save;
    }

    //== Fonction pour modifier les infos de la boutique
    public function update_boutique($id, $boutique)
    {
        $model = new BoutiqueModel();
        $update = $model->update($id, $boutique);
        return $update;
    }
}
