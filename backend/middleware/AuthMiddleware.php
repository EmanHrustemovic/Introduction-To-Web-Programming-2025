<?php

namespace App\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\services\Config;
use Flight;


class AuthMiddleware{
    
    public function verifyToken($token){
        if(!$token){
            Flight::halt(401,'Nedostaje zaglavlje za autentifikaciju.');
        
        };
        $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(),'HS256'));

        Flight::set('user',$decoded_token->user);

        Flight::set('jwt_token',$token);

        return TRUE; 
    }

    public function authorizeRole($requiredRole){
        
        $user = Flight::get('user');


        if ($user->role !== $requiredRole){

            Flight::halt(403,'Pristup odbijen : Nemate potrebna ovlaštenja !');
        }
    }

    public function authorizeRoles($roles){

        $user = Flight::get('user');

        if (!in_array($user->role,$roles)) {
            
            Flight::halt(403, 'Zabrana: nemate odgovarajuću ulogu.');
        }
    }
    
    function authorizePermission($permission) {

        $user = Flight::get('user');
        
        if (!in_array($permission, $user->permissions)) {
            
            Flight::halt(403, 'Pristup odbijen : Nedostaje dozvola !');
        }
    }   
}
?>