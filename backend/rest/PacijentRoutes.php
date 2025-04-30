<?php

require_once __DIR__ . '/../dao/PacijentDao.php';
require_once __DIR__ . '/../services/pacijentService.php';

use App\dao\PacijentDao;
use App\services\pacijentService;


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

Flight::route('GET /patient',function(){

    $dao = new PacijentDao();
    $patients = $dao -> getAllPatients();
    Flight::json($patients);

    //RADI 

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

Flight::route('GET /patient/@id' , function($id){

    $dao = new PacijentDao();
    $patient = $dao -> getPatientByID($id);
    Flight::json($patient);

    //RADI 
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
 *         description="Pacijent uspiješno dodan u bazu."
 *     )
 * )
 */

Flight::route('POST /patient/add',function(){
    $data = Flight::request()->data;

    $pacijent_id =$data -> pacijent_id;
    $JMBG = $data -> JMBG;
    $grad = $data -> grad;
    $tezina = $data -> tezina;
    $visina = $data -> visina;
    $datumRodenja = $data -> datumRodenja;
    $nazivOsiguranika = $data -> nazivOsiguranika;

    $service = new pacijentService();
    $new_patient = $service->addPatient($pacijent_id,$JMBG,$grad,$tezina,$visina,$datumRodenja,$nazivOsiguranika);
    Flight::json($new_patient);

    //RADI UREDNO 
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
 *         description="Pacijent nije pronađen u bazi ."
 *     )
 * )
 */

Flight::route('PUT /patient/@id',function($id){

    $data = Flight::request()->data;

    $service = new pacijentService();
    $change_patient = $service -> updatePatient($id, $data);

    Flight::json($change_patient);

    //RADI UREDNO 

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
 *         description="Patient uspiješno izbrisan."
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Patient nije pronađen ."
 *     )
 * )
 */

Flight::route('DELETE /patient/@id',function($id){

    $message = "";

    $service = new pacijentService();

    $remove_patient = $service -> deletePatient($id);
    Flight::json($remove_patient);

    if ($remove_patient) {
        $message =  "Pacijent je uspješno izbrisan iz baze podataka .";
    } else {
        $message = "Pacijent nije uspješno izbrisan iz baze podataka.";
    }
    print($message);

    //RADI 
});
