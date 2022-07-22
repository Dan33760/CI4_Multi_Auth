<?php

use App\Models\UserModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// ----- Recuperer le JWT depuis la requete --------
function getJWTFromRequest($authenticationHeader): string
{
    if(is_null($authenticationHeader)) {
        throw new Exception('Missing or invalid JWT in request');
    }

    return explode(' ', $authenticationHeader)['1'];
}

// ----- Valider le JWT depuis la requete --------
function validateJWTFromRequest(string $encodedToken)
{
    $key = Services::getSecretKey();
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));

    $userModel = new UserModel();
    $userModel->get_all($decodedToken->email);
}

// ----- Generer le JWT pour l'utilisateur --------
function getSignedJWTForUser(int $id, string $email, string $role)
{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
    $payload = [
        'id' => $id,
        'email' => $email,
        'role' => $role,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration
    ];

    $jwt = JWT::encode($payload, Services::getSecretKey(), "HS256");
    
    return $jwt;
}

// // ---- Recuperer les info du token ----------
function getUserPayload($encodedToken)
{
    $key = Services::getSecretKey();
    $encodedToken = getJWTFromRequest($encodedToken);

    return $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
}


