<?php

use Faker\Factory;
use App\dao\PacijentDao;

$dao = null;
$faker = null;

$data = null;

beforeAll(function () use (&$dao, &$faker) {
    $dao = new PacijentDao();
    $faker = Factory::create();
});

function pacijentData(?\Faker\Generator $faker)
{
    return [
        'JMBG' => $faker->unique()->text(6),
        'punoIme' => $faker->name,
        'email' => $faker->email(),
        'password' => $faker->password(12),
        'grad' => $faker->city(),
        'težina' => null,
        'visina' => null,
        'datumRođenja' => $faker->date(),
        'nazivOsiguranika' => $faker->name()

    ];
}

beforeEach(function () use (&$faker, &$bookingData) {
     $data = pacijentData($faker);
});



test('can add a  new patient', function () use (&$dao, &$faker, &$data) {


    $zdravstveniKartonData = pacijentData($faker);
    $id = $dao->addPatient($zdravstveniKartonData);

    expect($id)->toBeGreaterThan(0);

     $patient = $dao->getPatientByID($id);
     expect($patient)->not->toBeNull()
         ;
});


/**
 * @param array $kartonData
 * @return void
 */
function writeToConsole(array $kartonData): void
{
    fwrite(STDERR, print_r($kartonData, true));
}

test('can edit a  carton', function () use (&$dao, &$faker, &$data) {

    $kartonData = pacijentData($faker);

    writeToConsole($kartonData);


    $id = $dao->dodajKarton($kartonData);
//
    $kartonData['nazivBolesti'] = 'NAZIV';
    writeToConsole($kartonData);
    $dao->izmjeniKarton($id, $kartonData);
//
    $updatedKarton = $dao->kartoniPoID($id);
    expect($updatedKarton)->not()->toBeNull()
//    ->and($updatedKarton['nazivBolesti'])->toBe($kartonData['nazivBolesti'])
    ;

    // $booking = $dao->findById($id);
    // expect($booking)->not->toBeNull()
    //     ->and($booking->user_id)->toBe($bookingData['user_id']);
});


test('can delete carton', function () use (&$dao, &$faker, &$data) {


    $zdravstveniKartonData = pacijentData($faker);
    $id = $dao->dodajKarton($zdravstveniKartonData);

    expect($id)->toBeGreaterThan(0);

    $dao->obrišiKarton($id);

    $karton = $dao->kartoniPoID($id);

    expect($karton)->toBeFalse();
});
