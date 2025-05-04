<?php

require_once __DIR__ . '/../dao/PreglediDao.php';
use App\dao\PreglediDao;


Flight::route('GET /connection-check', function() {
    $projectService = Flight::projectService();
    echo $projectService->connStatus;
});

/**
 * @OA\Get(
 *     path="/checks",
 *     tags={"Pregledi"},
 *     summary="Get all checks",
 *     @OA\Response(
 *         response=200,
 *         description="Lista svih pregleda"
 *     )
 * )
 */
Flight::route('GET /checks', function() {

    $all_checks = Flight::pregledi_service()->getAll();
    Flight::json($all_checks);
});

/**
 * @OA\Get(
 *     path="/checks/{id}",
 *     tags={"Pregledi"},
 *     summary="Get check by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID pregleda",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pregled pronađen po ID-u"
 *     )
 * )
 */
Flight::route('GET /checks/@id', function($id) {

    $check = Flight::pregledi_service()->getByID($id);
    Flight::json($check);
});

/**
 * @OA\Post(
 *     path="/checks/add",
 *     tags={"Pregledi"},
 *     summary="Add a new check",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nazivPregleda", "datum_vrijeme", "status", "opis", "rezultati", "odjeljenje_id", "doktor_id", "preporuka"},
 *             @OA\Property(property="id", type="integer", example=10),
 *             @OA\Property(property="nazivPregleda", type="string", example="Ultrazvuk abdomena"),
 *             @OA\Property(property="datum_vrijeme", type="string", format="date-time", example="2025-04-03T10:30:00"),
 *             @OA\Property(property="status", type="string", example="zakazan"),
 *             @OA\Property(property="opis", type="string", example="Detaljan opis pregleda"),
 *             @OA\Property(property="rezultati", type="string", example="Nema abnormalnosti"),
 *             @OA\Property(property="odjeljenje_id", type="integer", example=3),
 *             @OA\Property(property="doktor_id", type="integer", example=7),
 *             @OA\Property(property="preporuka", type="string", example="Kontrola za 6 mjeseci")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pregled uspješno dodat"
 *     )
 * )
 */
Flight::route('POST /checks/add', function() {
    $data = Flight::request()->data;

    $new_check = Flight::pregledi_service()->add($data);

    Flight::json(['message' => 'Pregled uspješno dodat.']);
});

/**
 * @OA\Put(
 *     path="/checks/{id}",
 *     tags={"Pregledi"},
 *     summary="Update a check",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID pregleda za izmjenu",
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nazivPregleda", type="string", example="Ultrazvuk abdomena"),
 *             @OA\Property(property="datum_vrijeme", type="string", format="date-time", example="2025-04-03T10:30:00"),
 *             @OA\Property(property="status", type="string", example="zavrseno"),
 *             @OA\Property(property="opis", type="string", example="Sve u redu"),
 *             @OA\Property(property="rezultati", type="string", example="Normalni nalazi"),
 *             @OA\Property(property="odjeljenje_id", type="integer", example=3),
 *             @OA\Property(property="doktor_id", type="integer", example=7),
 *             @OA\Property(property="preporuka", type="string", example="Kontrola za godinu dana")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pregled uspješno ažuriran"
 *     )
 * )
 */
Flight::route('PUT /checks/@id', function($id) {
    $data = Flight::request()->data;

    $service = Flight::pregledi_service();
    $service->update($id, $data);

    Flight::json(['message' => 'Pregled uspješno ažuriran.']);
});

/**
 * @OA\Delete(
 *     path="/checks/{id}",
 *     tags={"Pregledi"},
 *     summary="Delete a check by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID pregleda za brisanje",
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pregled uspješno izbrisan"
 *     )
 * )
 */
Flight::route('DELETE /checks/@id', function($id) {
    $service = Flight::pregledi_service();
    $service->delete($id);

    Flight::json(['message' => 'Pregled uspješno izbrisan.']);
});
