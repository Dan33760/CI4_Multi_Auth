<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    //== Redirection selon le profil de l'utilisateur apres connection
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->get('isLoggedIn'))
        {
            if(session()->get('role') == "admin") {
                return redirect()->to(base_url('admin'));
            }

            if(session()->get('role') == "tenant") {
                return redirect()->to(base_url('tenant'));
            }

            if(session()->get('role') == "client") {
                return redirect()->to(base_url('client'));
            }
        }
    }

    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       

    }
}
