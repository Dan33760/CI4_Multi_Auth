<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\BoutiqueModel;

class AdminController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        return view('admin/dashboard');
    }

    //== list des utilisateurs pour l'admin
    public function users()
    {
        $data = [];
        $userModel = new UserModel();
        $roleModel = new RoleModel();

        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
        $data['perPage'] = 10;
        $data['total'] = $userModel->where('ETAT_USER >=', 1)->countAll();
        $data['users'] = $userModel->where('ETAT_USER >=', 1)->paginate($data['perPage']);
        $data['pager'] = $userModel->pager;

        $data['roles'] = $roleModel->get_all();

        return $this->getResponse($data, ResponseInterface::HTTP_OK);
    }

    //== list des boutiques d'un tenant pour l'admin
    public function boutiques($id_tenant)
    {
        $data = [];
        $boutiqueModel = new BoutiqueModel();
        $user_role = null;

        $data['boutiques'] = $boutiqueModel->get_by_user($id_tenant, $user_role);

        return $this->getResponse($data, ResponseInterface::HTTP_OK);

    }

    //enregistrement d'un client par un tenant
    public function user_add()
    {
        if($this->request->getPost())
        {
            $rules = [
                'role' => 'required',
                'nom' => 'required|min_length[3]|max_length[50]',
                'postnom' => 'required|max_length[50]',
                'email' => 'required|min_length[3]|max_length[50]|valid_email|is_unique[users.EMAIL_USER]',
            ];

            $input = $this->getRequestInput($this->request);

            if(!$this->validateRequest($input, $rules))
            {
                return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
            }else{

                $user = [
                    'REF_ROLE_USER' => $this->request->getVar('role'),
                    'NOM_USER' => $this->request->getVar('nom'),
                    'POSTNOM_USER' => $this->request->getVar('postnom'),
                    'EMAIL_USER' => $this->request->getVar('email'),
                    'MDP_USER' => $this->request->getVar('mdp'),
                ];

                $userModel = new UserModel();
                $save = $userModel->insert($user);
                $response = ['message' => 'Utilisateur creer avec success'];

                return $this->getResponse($response, ResponseInterface::HTTP_CREATED);
            }
        }
        $response = ['message' => 'Ajouter un utilisateur'];
        return $this->getResponse($response, ResponseInterface::HTTP_OK);
    }

    //== Activation d'un utilisateur
    public function user_active($id)
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
        $response = ['message' => 'Etat utilisateur modifié'];

        return $this->getResponse($response, ResponseInterface::HTTP_OK);

    }

    //== Suppression d'un utilisateur
    public function user_delete($id)
    {
        $clientModel = new UserModel();
        $data = ['ETAT_USER' => 0];
        $active = $clientModel->update($id, $data);

        $response = ['message' => 'Utilisateur supprimé'];

        return $this->getResponse($response, ResponseInterface::HTTP_OK);
    }
}
