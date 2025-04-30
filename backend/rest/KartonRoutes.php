<?php

require_once __DIR__ . '/../dao/ZdravstveniKartonDao.php';
require_once __DIR__ . '/../services/zdravstveniKartonService.php';

use App\dao\ZdravstveniKartonDao;
use App\services\zdravstveniKartonService;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

/**
 * @OA\Get(
 *     path="/cards",
 *     tags={"Zdravstveni kartoni"},
 *     summary="Get all medical cards",
 *     @OA\Response(
 *         response=200,
 *         description="Lista svih zdravstvenih kartona"
 *     )
 * )
 */

Flight::route('GET /cards', function(){

    $dao = new ZdravstveniKartonDao();
    $card = $dao->izlistajKarton();

    Flight::json($card);
    //RADI 
});

/**
 * @OA\Get(
 *     path="/cards/{id}",
 *     tags={"Zdravstveni kartoni"},
 *     summary="Get medical card by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID zdravstvenog kartona",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Zdravstveni karton pronađen po ID-u"
 *     )
 * )
 */

Flight::route('GET /cards/@id',function($id){

    $dao = new ZdravstveniKartonDao();

    $card_by_id = $dao->kartoniPoID($id);
    Flight::json($card_by_id);

    //RADI 
});

/**
 * @OA\Post(
 *     path="/cards/add",
 *     tags={"Zdravstveni kartoni"},
 *     summary="Add a new medical card",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id", "sifraBolesti", "nazivBolesti", "dijagnoza", "terapija", "pacijent_id", "pregledi_id", "doktor_id"},
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="sifraBolesti", type="string", example="012478"),
 *             @OA\Property(property="nazivBolesti", type="string", example="Diabetes mellitus"),
 *             @OA\Property(property="dijagnoza", type="string", example="diabetes type 1"),
 *             @OA\Property(property="terapija", type="string", example="Insulin therapy"),
 *             @OA\Property(property="pacijent_id", type="integer", example=3),
 *             @OA\Property(property="pregledi_id", type="integer", example=5),
 *             @OA\Property(property="doktor_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Novi zdravstveni karton uspješno dodat"
 *     )
 * )
 */

Flight::route('POST /cards/add', function(){

    $data = Flight::request()->data;

    $id = $data->id;
    $sifraBolesti = $data->sifraBolesti;
    $nazivBolesti = $data->nazivBolesti;
    $dijagnoza = $data -> dijagnoza;
    $terapija = $data -> terapija;
    $pacijent_id = $data -> pacijent_id;
    $pregledi_id = $data -> pregledi_id;
    $doktor_id = $data -> doktor_id;

    $service = new zdravstveniKartonService();

    $novi_karton = $service->dodajKarton($id,$sifraBolesti,$nazivBolesti,$dijagnoza,$terapija,$pacijent_id,$pregledi_id,$doktor_id);
    Flight::json($novi_karton);

    Flight::json(['message' => 'Novi karton je uspješno dodat.']);

    // RADI
});

/**
 * @OA\Put(
 *     path="/cards/{id}",
 *     tags={"Zdravstveni kartoni"},
 *     summary="Update an existing medical card",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID zdravstvenog kartona",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="sifraBolesti", type="string", example="012478"),
 *             @OA\Property(property="nazivBolesti", type="string", example="Asthma"),
 *             @OA\Property(property="dijagnoza", type="string", example="Mild Asthma"),
 *             @OA\Property(property="terapija", type="string", example="Inhaler"),
 *             @OA\Property(property="pacijent_id", type="integer", example=3),
 *             @OA\Property(property="pregledi_id", type="integer", example=5),
 *             @OA\Property(property="doktor_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Zdravstveni karton uspješno izmjenjen"
 *     )
 * )
 */

Flight::route('PUT /cards/@id',function($id){

    $data = Flight::request()->data;

    $service = new zdravstveniKartonService();
    $izmjeni_karton = $service -> izmjeniKarton($id,$data);

    Flight::json($izmjeni_karton);
    //RADI
});

/**
 * @OA\Delete(
 *     path="/cards/{id}",
 *     tags={"Zdravstveni kartoni"},
 *     summary="Delete medical card by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID zdravstvenog kartona za brisanje",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Zdravstveni karton uspješno izbrisan"
 *     )
 * )
 */

Flight::route('DELETE /cards/@id',function($id){

    $service = new zdravstveniKartonService();

    $ukloni_karton = $service -> obrisiKarton($id);
    Flight::json($ukloni_karton);
    // NE RADI
});

