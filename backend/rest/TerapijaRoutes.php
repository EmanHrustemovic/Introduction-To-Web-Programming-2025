<?php

require_once __DIR__ . '/../dao/TerapijaDao.php';
use App\dao\TerapijaDao;

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
Flight::route('GET /therapy', function(){
    $therapy_list = Flight::terapija_service()->getAll();  
    Flight::json($therapy_list);
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
Flight::route('GET /therapy/@id', function($id){
    $therapy = Flight::terapija_service()->getByID($id);  
    Flight::json($therapy);
});


/**
 * @OA\Post(
 *     path="/therapy/add",
 *     tags={"Terapije"},
 *     summary="Add a new therapy record",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"terapija_id", "vrsta", "doza_i_uputa", "trajanje", "kontrola", "doktor_id", "pregledi_id"},
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
    $new_therapy = Flight::terapija_service()->add($data);  
    Flight::json(['message' => 'Terapija uspješno dodana.']);
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
    $updated_therapy = Flight::terapija_service()->update($id, $data);  
    Flight::json(['message' => 'Terapija uspješno ažurirana.']);
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
    $delete_result = Flight::terapija_service()->delete($id);  
    if ($delete_result) {
        Flight::json(['message' => 'Terapija uspješno izbrisana iz baze.']);
    } else {
        Flight::json(['message' => 'Terapija nije pronađena ili nije izbrisana.']);
    }
});

