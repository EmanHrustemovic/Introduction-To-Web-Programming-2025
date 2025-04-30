<?php


require_once __DIR__ . '/../dao/DoctorDao.php';
require_once __DIR__ . '/../services/DoctorService.php';

use App\dao\DoctorDao;
use App\services\DoctorService;

/**
 * @OA\Get(
 *     path="/doctors",
 *     tags={"Doktori"},
 *     summary="Get all doctors",
 *     @OA\Response(
 *         response=200,
 *         description="Lista svih doktora"
 *     )
 * )
 */

Flight::route('GET /doctors' , function(){

    $dao = new DoctorDao();
    $all_doctors = $dao->getAllDoctors();

    Flight::json($all_doctors);

    //RADI
});

/**
 * @OA\Get(
 *     path="/doctors/{id}",
 *     tags={"Doktori"},
 *     summary="Get doctor by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID doktora",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doktor pronađen po ID-u"
 *     )
 * )
 */

Flight::route('GET /doctors/@id',function($id){
    
    $dao = new DoctorDao();
    $doctors_by_id = $dao->getByDocID($id);

    Flight::json($doctors_by_id);

    //RADI
});

/**
 * @OA\Post(
 *     path="/doctors/add",
 *     tags={"Doktori"},
 *     summary="Add a new doctor",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "titula", "odjeljenje"},
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="titula", type="string", example="Prim. Dr."),
 *             @OA\Property(property="odjeljenje", type="string", example="Interna medicina")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doktor uspješno dodat"
 *     )
 * )
 */

Flight::route('POST /doctors/add', function () {
    $data = Flight::request()->data;

    $user_id = $data->user_id;
    $titula = $data->titula;
    $odjeljenje = $data->odjeljenje;

    $service = new DoctorService();
    $service->addDoctor($user_id, $titula, $odjeljenje);

    Flight::json(['message' => 'Doktor uspješno dodat.']);

    //Radi
});

/**
 * @OA\Put(
 *     path="/doctors/{id}",
 *     tags={"Doktori"},
 *     summary="Update doctor by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID doktora za izmjenu",
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="titula", type="string", example="Specijalista"),
 *             @OA\Property(property="odjeljenje", type="string", example="Ortopedija")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doktor uspješno ažuriran"
 *     )
 * )
 */

Flight::route('PUT /doctors/@id',function($id){
    $data = Flight::request()->data;

    $service = new DoctorService();
    $updated_doctor = $service-> updateDoctor($id,$data);

    Flight::json($updated_doctor);
//RADI
});

/**
 * @OA\Delete(
 *     path="/doctors/{id}",
 *     tags={"Doktori"},
 *     summary="Delete doctor by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID doktora za brisanje",
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Doktor uspješno obrisan"
 *     )
 * )
 */

Flight::route('DELETE /doctors/@id' , function($id){

    $message = "";

    $service = new DoctorService();

    $delete_doctor = $service-> deleteDoctor($id);

    if ($delete_doctor) {
        $message =  "Doktor je uspješno izbrisan iz baze podataka .";
    } else {
        $message = "Doktor nije uspješno izbrisan iz baze podataka.";
    }
    print($message);
//RADI
});
