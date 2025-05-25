<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'vendor/autoload.php';
require __DIR__ . "/services/config.php";
require 'services/AuthService.php';
require __DIR__ . "/middleware/AuthMiddleware.php";
require __DIR__ . "/middleware/DoctorMiddleware.php";
require __DIR__ . "/middleware/PatientMiddleware.php";


Flight::register('doctor_service', 'App\\services\\DoctorService');
Flight::register('terapija_service', 'App\\services\\TerapijaServices');
Flight::register('korisnik_service', 'App\services\KorisnikService');
Flight::register('laboratorija_service', 'App\services\LaboratorijaService');
Flight::register('pacijent_service', 'App\services\PacijentService');
Flight::register('pregledi_service', 'App\services\PreglediService');
Flight::register('kartoni_service', 'App\services\PreglediService');
Flight::register('auth_service','App\services\AuthService');
Flight::register('auth_middleware', "App\middleware\AuthMiddleware");
Flight::register('doctor_middleware', 'App\middleware\DoctorMiddleware');
Flight::register('patient_middleware', 'App\middleware\PatientMiddleware');
Flight::register('config', 'App\services\config');


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

Flight::start();