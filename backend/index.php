<?php

require 'vendor/autoload.php';

require  'rest/DoctorRoutes.php';
require  'rest/KorisnikRoutes.php';
require 'rest/LaboratorijaRoutes.php';
require 'rest/PacijentRoutes.php';
require  'rest/KartonRoutes.php';
require  'rest/PreglediRoutes.php';
require  'rest/TerapijaRoutes.php';
//require_once __DIR__ . '/../routes/otpRoutes.php';


// Add a path to the autoloader
//Flight::path(__DIR__ . 'rest/DoctorRoutes.php');
// Set the application path
//Flight::path(__DIR__ . '/../app');
//prep app variable
//$app = Flight::app();



Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('/emko', function(){
    echo 'hello world emkooo!';
});


Flight::start();