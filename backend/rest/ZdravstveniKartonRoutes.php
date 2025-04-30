<?php

require_once __DIR__ . '/../services/ZdravstveniKartonService.php';
use App\services\ZdravstveniKartonService;

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
Flight::route('GET /cards', function() {
    $service = new ZdravstveniKartonService();
    
    $all = $service->getAll();            
    Flight::json($all);
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
Flight::route('GET /cards/@id', function($id) {
    $service = new ZdravstveniKartonService();
   
    $one = $service->getById($id);       
    Flight::json($one);
});

/**
 * @OA\Post(
 *     path="/cards",
 *     tags={"Zdravstveni kartoni"},
 *     summary="Add a new medical card",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"sifraBolesti","nazivBolesti","dijagnoza","terapija","pacijent_id","pregledi_id","doktor_id"},
 *             @OA\Property(property="sifraBolesti", type="string", example="012478"),
 *             @OA\Property(property="nazivBolesti", type="string", example="Diabetes mellitus"),
 *             @OA\Property(property="dijagnoza", type="string", example="type 1"),
 *             @OA\Property(property="terapija", type="string", example="Insulin therapy"),
 *             @OA\Property(property="pacijent_id", type="integer", example=3),
 *             @OA\Property(property="pregledi_id", type="integer", example=5),
 *             @OA\Property(property="doktor_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Novi zdravstveni karton uspješno dodat"
 *     )
 * )
 */
Flight::route('POST /cards', function() {
    $data = Flight::request()->data->getData();

    $service = new ZdravstveniKartonService();
    $created = $service->create($data);           

    Flight::json($created, 201);
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
Flight::route('PUT /cards/@id', function($id) {
    $data = Flight::request()->data->getData();
    
    $service = new ZdravstveniKartonService();
    $updated = $service->update($id, $data);     
    Flight::json($updated);
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
Flight::route('DELETE /cards/@id', function($id) {
    $service = new ZdravstveniKartonService();
    
    $deleted = $service->delete($id);          
    if ($deleted) {
        Flight::json(['message' => 'Karton uspješno izbrisan']);
    } else {
        Flight::json(['message' => 'Karton nije pronađen'], 404);
    }
});
