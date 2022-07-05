<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    //== Redirection sur login si l'utilisateur n'est pas connecté
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }
    }

    //== Redirection sur login si l'utilisateur tente d'acceder a l'url qui n'est pas de son profil
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $uri = service('uri');
        
        if(session()->get('role') == "admin" AND $uri->getSegment(1) != "admin") {
            return redirect()->to(base_url('logout'));
        }

        if(session()->get('role') == "tenant" AND $uri->getSegment(1) != "tenant") {
            return redirect()->to(base_url('logout'));
        }

        if(session()->get('role') == "client" AND $uri->getSegment(1) != "client") {
            return redirect()->to(base_url('logout'));
        }
        
    }

}
