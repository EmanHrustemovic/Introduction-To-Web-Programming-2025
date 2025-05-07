<?php

require_once __DIR__ . '/../dao/DoctorDao.php';
use App\dao\DoctorDao;


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
Flight::route('GET /doctors', function () {
    Flight::json(Flight::doctor_service()->getAll());
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
Flight::route('GET /doctors/@id', function ($id) {
    Flight::json(Flight::doctor_service()->getById($id));
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
    $data = Flight::request()->data->getData();
    Flight::doctor_service()->create($data);
    Flight::json(['message' => 'Doktor uspješno dodat.']);
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
Flight::route('PUT /doctors/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::doctor_service()->update($id, $data);
    Flight::json(['message' => 'Doktor uspješno ažuriran.']);
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
Flight::route('DELETE /doctors/@id', function ($id) {
    $deleted = Flight::doctor_service()->delete($id);
    if ($deleted) {
        Flight::json(['message' => 'Doktor uspješno izbrisan.']);
    } else {
        Flight::json(['message' => 'Doktor nije pronađen.'], 404);
    }
});
