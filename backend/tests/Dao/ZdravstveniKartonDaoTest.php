<?php

use Faker\Factory;
use App\dao\ZdravstveniKartonDao;

$dao = null;
$faker = null;

$data = null;

beforeAll(function () use (&$dao, &$faker) {
    $dao = new ZdravstveniKartonDao();
    $faker = Factory::create();
});

function zdravstveniKartonData(?\Faker\Generator $faker)
{
    return [
        'sifraBolesti' => $faker->unique()->text(6),
        'nazivBolesti' => $faker->words(3, true),
        'dijagnoza' => $faker->words(11,true),
        'terapija' => $faker->words(11,true),
        'JMBG' => $faker->randomNumber(6),
        'pregledi_id' => null ,
        'doktor_id' => null

    ];
}

beforeEach(function () use (&$faker, &$bookingData) {
     $data = zdravstveniKartonData($faker);
});



test('can add a  new carton', function () use (&$dao, &$faker, &$data) {


    $zdravstveniKartonData = zdravstveniKartonData($faker);
    $id = $dao->dodajKarton($zdravstveniKartonData);

    expect($id)->toBeGreaterThan(0);

     $karton = $dao->kartoniPoID($id);
     expect($karton)->not->toBeNull()
         ->and($karton['nazivBolesti'])->toBe($zdravstveniKartonData['nazivBolesti']);
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

    $kartonData = zdravstveniKartonData($faker);

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


    $zdravstveniKartonData = zdravstveniKartonData($faker);
    $id = $dao->dodajKarton($zdravstveniKartonData);

    expect($id)->toBeGreaterThan(0);

    $dao->obrišiKarton($id);

    $karton = $dao->kartoniPoID($id);

    expect($karton)->toBeFalse();
});
