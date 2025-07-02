<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'vendor/autoload.php';
require __DIR__ . "/services/config.php";
require 'services/AuthService.php';
require __DIR__ . "/middleware/AuthMiddleware.php";



Flight::register('doctor_service', 'App\\services\\DoctorService');
Flight::register('terapija_service', 'App\\services\\TerapijaServices');
Flight::register('korisnik_service', 'App\services\KorisnikService');
Flight::register('laboratorija_service', 'App\services\LaboratorijaService');
Flight::register('pacijent_service', 'App\services\PacijentService');
Flight::register('pregledi_service', 'App\services\PreglediService');
Flight::register('kartoni_service', 'App\services\ZdravstveniKartonService');
Flight::register('auth_service','App\services\AuthService');
Flight::register('auth_middleware', "App\middleware\AuthMiddleware");
Flight::register('config', 'App\services\Config');


Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/emko', function(){
    echo 'hello world emkooo!';
});

Flight::route('/*', function() {
    if(
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/auth/register') === 0
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Auth");
            if(Flight::auth_middleware()->verifyToken($token))
                return TRUE;
            /*
            $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
 
 
            Flight::set('user', $decoded_token->user);
            Flight::set('jwt_token', $token);
            return TRUE;
            */
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
 });

require_once __DIR__ . '/rest/AuthRoutes.php';

require 'rest/DoctorRoutes.php';
require 'rest/KorisnikRoutes.php';
require 'rest/LaboratorijaRoutes.php';
require 'rest/PacijentRoutes.php';
require 'rest/ZdravstveniKartonRoutes.php';
require 'rest/PreglediRoutes.php';
require 'rest/TerapijaRoutes.php';
require 'services/TerapijaServices.php'; 
require 'dao/MappingDao.php';
require 'services/DoctorService.php';
require 'services/KorisnikService.php';
require  'services/LaboratorijaService.php';
require 'services/PacijentService.php';
require 'services/PreglediService.php';
require 'services/ZdravstveniKartonService.php';


$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
//fwrite(fopen('php://stderr', 'w'), " ---- $origin \n");

// Allow any localhost port
$allowedOrigins = [
    'http://localhost',
    'http://localhost:4200',
    'http://localhost:8080',
    'http://localhost:8100',
    'http://terminko.app',
    'http://webProject.app',
];

foreach ($allowedOrigins as $allowedOrigin) {
    if (preg_match('/^' . preg_quote($allowedOrigin, '/') . '(:\d+)?$/', $origin)) {
    fwrite(fopen('php://stderr', 'w'), "MATCH ------ $origin \n");

    header("Access-Control-Allow-Origin: $origin");
    break;
    }
}

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, Auth');
header('Access-Control-Allow-Credentials: true');

// Handle OPTIONS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    fwrite(fopen('php://stderr', 'w'), "MATCH AND EXIT ------ $origin \n");

    exit(0);
}


Flight::start();