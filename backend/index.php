<?php

require 'vendor/autoload.php';

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

Flight::register('doctor_service', 'App\\services\\DoctorService');
Flight::register('terapija_service', 'App\\services\\TerapijaServices');
Flight::register('korisnik_service', 'App\services\KorisnikService');
Flight::register('laboratorija_service', 'App\services\LaboratorijaService');
Flight::register('pacijent_service', 'App\services\PacijentService');
Flight::register('pregledi_service', 'App\services\PreglediService');
Flight::register('kartoni_service', 'App\services\PreglediService');



Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/emko', function(){
    echo 'hello world emkooo!';
});

Flight::start();