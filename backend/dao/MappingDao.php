<?php

namespace App\dao;


use Flight;

Flight::register('DoctorDao', DoctorDao::class);
Flight::register('KorisnikDao', KorisnikDao::class);
Flight::register('LaboratorijaDao', LaboratorijaDao::class);
Flight::register('PacijentDao', PacijentDao::class);
Flight::register('PreglediDao', PreglediDao::class);
Flight::register('TerapijaDao', TerapijaDao::class);
Flight::register('ZdravstveniKartonDao', ZdravstveniKartonDao::class);