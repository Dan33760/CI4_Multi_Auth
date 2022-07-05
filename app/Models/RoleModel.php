<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'roles';
    protected $primaryKey       = 'ID_ROLE';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['DESIGNATION_ROLE', 'ETAT_ROLE'];

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

    //== recupere role client
    public function get_all()
    {
        $builder = $this->db->table('roles');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    //== recupere role client
    public function get_role()
    {
        $builder = $this->db->table('roles');
        $builder->select('*');
        $builder->where('DESIGNATION_ROLE', "client");
        $query = $builder->get();
        return $query->getResult();
    }

    //== recuperer roles clients et tenant
    public function get_client_tenant()
    {
        $where = "DESIGNATION_ROLE = 'client' OR DESIGNATION_ROLE = 'tenant'";

        $builder = $this->db->table('roles');
        $builder->select('*');
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }
}
