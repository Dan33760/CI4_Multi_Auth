<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class UserController extends BaseController
{
    // Se connecter a la plateforme
    public function login()
    {
        $data = [];
        helper(['form']);
        
        if($this->request->getPost())
        {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => ['validateUser' => "L'adresse mail ou le Mot de passe ne correspond pas!"]
            ];

            if(!$this->validate($rules, $errors)) {
                return view('login', ["validation" => $this->validator]);
            }else{
                $email = $this->request->getVar('email');
                $userModel = new UserModel();

                $user = $userModel->get_all($email);

                $this->setUserSession($user);

                if($user->DESIGNATION_ROLE == "admin") {
                    return redirect()->to(base_url('admin'));
                }
                elseif($user->DESIGNATION_ROLE == "tenant") {
                    return redirect()->to(base_url('tenant'));
                }
                elseif($user->DESIGNATION_ROLE == "client") {
                    return redirect()->to(base_url('client'));
                }
            }
        }
        return view('login');
    }


    // Fonction pour creer les sessions
    private function setUserSession($user)
    {
        $data = [
            'id' => $user->ID_USER,
            'nom' => $user->NOM_USER,
            'postnom' => $user->POSTNOM_USER,
            'role' => $user->DESIGNATION_ROLE,
            'email' => $user->EMAIL_USER,
            'image' => $user->IMAGE_USER,
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }

    // Creation d'un compte
    public function create_count()
    {
        $data = [];
        $roleModel = new RoleModel();

        if($this->request->getPost())
        {
            $rules = [
                'role' => 'required',
                'nom' => 'required|min_length[3]|max_length[50]',
                'postnom' => 'required|max_length[50]',
                'email' => 'required|min_length[3]|max_length[50]|valid_email|is_unique[users.EMAIL_USER]',
                'mdp' => 'required|max_length[50]',
                'mdp_confirm' => 'matches[mdp]',

            ];

            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else{

                $client = [
                    'REF_ROLE_USER' => $this->request->getVar('role'),
                    'NOM_USER' => $this->request->getVar('nom'),
                    'POSTNOM_USER' => $this->request->getVar('postnom'),
                    'EMAIL_USER' => $this->request->getVar('email'),
                    'MDP_USER' => $this->request->getVar('mdp'),
                ];

                $clientModel = new UserModel();
                $save = $clientModel->insert($client);
                
                if($save) {
                    $data['succes'] = "Compte enregistré";
                }else{
                    $data['error'] = "Compte non enregistré";
                }
            }
        }

        $data['roles'] = $roleModel->get_client_tenant();
        return view('create_count', $data);
    }
    
    // Detail et mofification du profil
    public function profil()
    {
        $current_user = session()->get('id');
        $userModel = new UserModel();
        $data = [];

        if($this->request->getPost())
        {
            $rules = [
                'nom' => 'required|min_length[3]|max_length[50]',
                'postnom' => 'required|max_length[50]',
                'email' => 'required|min_length[3]|max_length[50]|valid_email',
                'mdp' => 'required|max_length[50]',
                'mdp_confirm' => 'matches[mdp]',
            ];

            $session = session();

            if(!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }else{

                $client = [
                    'NOM_USER' => $this->request->getVar('nom'),
                    'POSTNOM_USER' => $this->request->getVar('postnom'),
                    'EMAIL_USER' => $this->request->getVar('email'),
                    'MDP_USER' => $this->request->getVar('mdp'),
                ];

                $clientModel = new UserModel();

                $save = $clientModel->update($current_user,$client);

                if($save) {
                    $data['success'] = "Profil modifié";
                }else{
                    $data['error'] = "Profil non modifié";
                }
            }
        }

        $data['user'] = $userModel->find($current_user);

        return view('profil', $data);
    }

    //== Changer la photo de profil
    public function update_picture()
    {
        $uri = service('uri');
        if($this->request->getPost())
        {
            $rules = [
                'image_user' => "uploaded[image_user]|is_image[image_user]|mime_in[image_user,image/jpg,image/jpeg,image/png]",
            ];

            $session = session();

            if(!$this->validate($rules))
            {
                $data = $this->validator;
                $session->setFlashdata('validation', $data->listErrors());
            }else{
                $image = $this->request->getFile('image_user');
                $image->move('uploads/users');

                $client_image = [
                    'IMAGE_USER' => 'uploads/users/'.$image->getClientName()
                ];
                $current_user = session()->get('id');

                $clientModel = new UserModel();
                $save = $clientModel->update($current_user,$client_image);

                if($save) {
                    $session->setFlashdata('success', "Photo enregistré");
                }else{
                    $session->setFlashdata('error', "Photo non enregistré");
                }
            }
        }
        return redirect()->to('/'.$uri->getSegment(1).'/profil');
    }

    // Suppression du compte d'un client
    public function delete_count()
    {
        $current_user = session()->get('id');
        $userModel = new UserModel();

        $delete = $userModel->soft_delete($current_user);
        if($delete){
            return $this->logout();
        }else{
            return redirect()->to('/profil');
        }
    }

    // Se deconnecter
    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
