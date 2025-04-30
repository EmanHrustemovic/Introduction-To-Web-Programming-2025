<?php

require_once __DIR__ . '/../dao/TerapijaDao.php';
require_once __DIR__ . '/../services/terapijaServices.php';

use App\dao\TerapijaDao;
use App\services\TerapijaServices;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

/**
 * @OA\Get(
 *     path="/therapy",
 *     tags={"Terapije"},
 *     summary="Get all therapy records",
 *     @OA\Response(
 *         response=200,
 *         description="Lista svih terapija."
 *     )
 * )
 */

Flight::route('GET /therapy',function(){

    $dao = new TerapijaDao();
    $terapija = $dao -> getAllTherapy();
    Flight::json($terapija);
    
    //RADI
});

/**
 * @OA\Get(
 *     path="/therapy/{id}",
 *     tags={"Terapije"},
 *     summary="Get therapy by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Therapy ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Teerapije po ID-u."
 *     )
 * )
 */

Flight::route('GET /therapy/@id',function($id){

    $dao = new TerapijaDao();
    $terapija_po_id = $dao -> getTherapyByID($id);
    Flight::json($terapija_po_id);

    //RADI 

});

/**
 * @OA\Post(
 *     path="/therapy/add",
 *     tags={"Terapije"},
 *     summary="Add a new therapy record",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id", "terapija_id", "vrsta", "doza_i_uputa", "trajanje", "kontrola", "doktor_id", "pregledi_id"},
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="terapija_id", type="integer", example=4),
 *             @OA\Property(property="vrsta", type="string", example="antibiotik"),
 *             @OA\Property(property="doza_i_uputa", type="string", example="2x dnevno"),
 *             @OA\Property(property="trajanje", type="string", format="date-time", example="2025-04-14 00:00:00"),
 *             @OA\Property(property="kontrola", type="string", format="date", example="2025-04-24"),
 *             @OA\Property(property="doktor_id", type="integer", example=7),
 *             @OA\Property(property="pregledi_id", type="integer", example=6)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Dodana nova terapija."
 *     )
 * )
 */

 Flight::route('POST /therapy/add', function(){

    $data = Flight::request()->data;

    $id = $data -> id;
    $terapija_id = $data -> terapija_id;
    $vrsta = $data -> vrsta;
    $doza_i_uputa = $data -> doza_i_uputa;
    $trajanje = $data -> trajanje;
    $kontrola = $data -> kontorla;
    $doktor_id = $data -> doktor_id;
    $pregledi_id = $data -> pregledi_id;


    $service = new terapijaServices();
    $nova_terapija = $service -> addTherapy($id,$terapija_id,$vrsta,$doza_i_uputa,$trajanje,$kontrola,$doktor_id, $pregledi_id);

    Flight::json($nova_terapija);

    //RADI
});

/**
 * @OA\Put(
 *     path="/therapy/{id}",
 *     tags={"Terapije"},
 *     summary="Update a therapy record",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Therapy ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="terapija_id", type="integer", example=4),
 *             @OA\Property(property="vrsta", type="string", example="analgetik"),
 *             @OA\Property(property="doza_i_uputa", type="string", example="1x dnevno"),
 *             @OA\Property(property="trajanje", type="string", format="date-time", example="2025-04-20 00:00:00"),
 *             @OA\Property(property="kontrola", type="string", format="date", example="2025-04-27"),
 *             @OA\Property(property="doktor_id", type="integer", example=8),
 *             @OA\Property(property="pregledi_id", type="integer", example=5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Terapija uspiješno ažurirana."
 *     )
 * )
 */

Flight::route('PUT /therapy/@id',function($id){

    $data = Flight::request()->data;

    $service = new terapijaServices();
    $izmjena = $service -> updateTherapy($id, $data);

    Flight::json($izmjena);

    //RADI

});

/**
 * @OA\Delete(
 *     path="/therapy/{id}",
 *     tags={"Terapije"},
 *     summary="Delete a therapy record",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Therapy ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Terapija izbirsana iz baze."
 *     )
 * )
 */

Flight::route('DELETE /therapy/@id',function($id){
    $service = new terapijaServices();

    $ukloni_terapiju = $service -> deleteTherapy($id);
    Flight::json($ukloni_terapiju);

    //RADI

});