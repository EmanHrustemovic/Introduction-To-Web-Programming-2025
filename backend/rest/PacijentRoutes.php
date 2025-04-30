<?php

require_once __DIR__ . '/../dao/PacijentDao.php';
require_once __DIR__ . '/../services/PacijentService.php';

use App\dao\PacijentDao;
use App\services\PacijentService;

Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

/**
 * @OA\Get(
 *     path="/patient",
 *     tags={"Pacijenti"},
 *     summary="Get all patients",
 *     @OA\Response(
 *         response=200,
 *         description="Lista svih pacijenata"
 *     )
 * )
 */
Flight::route('GET /patient', function() {
    $service = new PacijentService();
    $patients = $service->getAll();


    Flight::json($patients);

    Flight::json(['message' => 'Lista svih pacijenata je uspješno učitana.']);
});

/**
 * @OA\Get(
 *     path="/patient/{id}",
 *     tags={"Pacijenti"},
 *     summary="Get a patient by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Patient ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalji pacijenta po ID-u."
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pacijent nije pronađen."
 *     )
 * )
 */
Flight::route('GET /patient/@id', function($id) {
    $service = new PacijentService();
    
    $patient = $service->getById($id);

    if ($patient) {
        Flight::json($patient);
        Flight::json(['message' => 'Pacijent pronađen po ID-u.']);
    } else {
        Flight::json(['message' => 'Pacijent nije pronađen.'], 404);
    }
});

/**
 * @OA\Post(
 *     path="/patient/add",
 *     tags={"Pacijenti"},
 *     summary="Add a new patient",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"pacijent_id","JMBG","grad","tezina","visina","datumRodenja","nazivOsiguranika"},
 *             @OA\Property(property="pacijent_id", type="integer", example=2),
 *             @OA\Property(property="JMBG", type="string", example="0304002088881"),
 *             @OA\Property(property="grad", type="string", example="Bihac"),
 *             @OA\Property(property="tezina", type="number", format="float", example=65.5),
 *             @OA\Property(property="visina", type="integer", example=200),
 *             @OA\Property(property="datumRodenja", type="string", format="date", example="1995-02-27"),
 *             @OA\Property(property="nazivOsiguranika", type="string", example="Energopetrol")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pacijent uspiješno dodat u bazu."
 *     )
 * )
 */
Flight::route('POST /patient/add', function() {
    $data = Flight::request()->data->getData();

    $service = new PacijentService();
    $created = $service->create($data);   
    Flight::json($created, 201);
});

/**
 * @OA\Put(
 *     path="/patient/{id}",
 *     tags={"Pacijenti"},
 *     summary="Update an existing patient",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Patient ID",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="JMBG", type="string", example="1205998123456"),
 *             @OA\Property(property="grad", type="string", example="Mostar"),
 *             @OA\Property(property="tezina", type="number", format="float", example=180.0),
 *             @OA\Property(property="visina", type="number", format="float", example=60.2),
 *             @OA\Property(property="datumRodenja", type="string", format="date", example="1998-05-12"),
 *             @OA\Property(property="nazivOsiguranika", type="string", example="ZZO")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pacijent uspiješno izmjenjen."
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pacijent nije pronađen u bazi."
 *     )
 * )
 */
Flight::route('PUT /patient/@id', function($id) {
    $data = Flight::request()->data->getData();

    $service = new PacijentService();
    $updated = $service->update($id, $data); 
    Flight::json($updated ? ['message'=>'Ažurirano'] : ['message'=>'Ne postoji'], $updated ? 200 : 404);
});

/**
 * @OA\Delete(
 *     path="/patient/{id}",
 *     tags={"Pacijenti"},
 *     summary="Delete a patient",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Patient ID to delete",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pacijent uspješno izbrisan."
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pacijent nije pronađen."
 *     )
 * )
 */
Flight::route('DELETE /patient/@id', function($id) {
    $service = new PacijentService();

    $deleted = $service->delete($id);      
    if ($deleted) {
        Flight::json(['message'=>'Pacijent izbrisan']);
    } else {
        Flight::json(['message'=>'Ne postoji'], 404);
    }
});