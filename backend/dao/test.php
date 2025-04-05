<?php

include __DIR__ . "\PreglediDao.class.php";
require __DIR__ . "\..\services\config.php";
//require __DIR__ . "\PreglediDao.class.php";
//require_once __DIR__ . "\PreglediDao.class.php" ;


$preglediDao = new PreglediDao();

$data = [
    'nazivPregleda' => 'Ultrazvuk abdomena',
    'datum_vrijeme' => '2025-04-03 10:30:00',
    'status' => 'zakazan',
    'opis' => 'Pregled radi provjere stanja unutrašnjih organa.',
    'rezultati' => 'Nema abnormalnosti',
    'odjeljenje_id' => 3,
    'doktor_id' => 7,
    'preporuka' => 'Ponoviti pregled za 6 mjeseci'
];


$preglediDao->dodajPregled($data);

    var_dump("===========================================");
    $allChecks = $preglediDao->getAllChecks();
    var_dump($allChecks);
    
    var_dump("===========================================");
    $pregled3 = $preglediDao->preglediPoId(3);
    var_dump($pregled3);
