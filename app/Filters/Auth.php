<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth implements FilterInterface
{
    //== Redirection sur login si l'utilisateur n'est pas connecté
    public function before(RequestInterface $request, $arguments = null)
    {
        // ------- Utilisation API --------------
        $key = getenv('JWT_SECRET');
        $header = $request->getHeader("Authorization");
        $token = null;

        //--- extraire le token du header
        if(!empty($header)) {
            if(preg_match('/Bearer\s(\S+)', $header, $matches)) {
                $token = $matches[1];
            }

        }

        //verifier si le token est null ou vide
        if(is_null($token) || empty($token)) {
            $response = service('response');
            $response->setBody('Access denied, token empty');
            $response->setStatusCode(401);
            return $response;
        }

        try{
            $decode = JWT::decode($token, new Key($key, 'HS256'));
        }catch(Exception $ex) {
            $response = service('response');
            $response->setBody('Access denied');
            $response->setStatusCode(401);
            return $response;
        }
    }

    //== Redirection sur login si l'utilisateur tente d'acceder a l'url qui n'est pas de son profil
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // $uri = service('uri');
        
        // if(session()->get('role') == "admin" AND $uri->getSegment(1) != "admin") {
        //     return redirect()->to(base_url('logout'));
        // }

        // if(session()->get('role') == "tenant" AND $uri->getSegment(1) != "tenant") {
        //     return redirect()->to(base_url('logout'));
        // }

        // if(session()->get('role') == "client" AND $uri->getSegment(1) != "client") {
        //     return redirect()->to(base_url('logout'));
        // }
        
    }

}
