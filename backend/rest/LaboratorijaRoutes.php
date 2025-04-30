<?php

require_once __DIR__ . '/../services/ProjectService.php';
require_once __DIR__ . '/../services/LaboratorijaService.php';

use App\services\LaboratorijaService;

/**
 * @OA\Get(
 *     path="/labs",
 *     tags={"Laboratorija"},
 *     summary="Get all laboratory records",
 *     @OA\Response(
 *         response=200,
 *         description="Lista svih laboratorijskih nalaza"
 *     )
 * )
 */
Flight::route('GET /labs', function() {
    $service = new LaboratorijaService();

    $all = $service->getAll();                  
    Flight::json($all);
});

/**
 * @OA\Get(
 *     path="/labs/{id}",
 *     tags={"Laboratorija"},
 *     summary="Get laboratory record by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID laboratorijskog nalaza",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Laboratorijski nalaz po ID-u"
 *     )
 * )
 */
Flight::route('GET /labs/@id', function($id) {
    $service = new LaboratorijaService();

    $item = $service->getById($id);             
    Flight::json($item);
});

/**
 * @OA\Post(
 *     path="/labs",
 *     tags={"Laboratorija"},
 *     summary="Add new laboratory record",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"sifraNalaza", "tipNalaza", "vrsta_uzorka", "datum_obrade", "status", "pregledi_id"},
 *             @OA\Property(property="sifraNalaza", type="string", example="123456"),
 *             @OA\Property(property="tipNalaza", type="string", example="Krv"),
 *             @OA\Property(property="vrsta_uzorka", type="string", example="Uzorak krvi"),
 *             @OA\Property(property="datum_obrade", type="string", format="date-time", example="2025-04-15T10:00:00"),
 *             @OA\Property(property="status", type="string", example="U procesu"),
 *             @OA\Property(property="pregledi_id", type="integer", example=5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Laboratorijski nalaz uspješno dodat"
 *     )
 * )
 */
Flight::route('POST /labs', function() {
    $data = Flight::request()->data->getData();

    $service = new LaboratorijaService();
    $created = $service->create($data);

    if ($created) {
        Flight::json([
            'message' => 'Laboratorijski nalaz je uspješno dodat u bazu.'
        ]);
    } else {
        Flight::json([
            'message' => 'Greška prilikom dodavanja laboratorijskog nalaza.'
        ], 500);
    }
});

/**
 * @OA\Put(
 *     path="/labs/{id}",
 *     tags={"Laboratorija"},
 *     summary="Update laboratory record",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID laboratorijskog nalaza",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="sifraNalaza", type="string", example="654321"),
 *             @OA\Property(property="tipNalaza", type="string", example="Uzorak mokraće"),
 *             @OA\Property(property="vrsta_uzorka", type="string", example="Mokraća"),
 *             @OA\Property(property="datum_obrade", type="string", format="date-time", example="2025-04-16T12:00:00"),
 *             @OA\Property(property="status", type="string", example="Završeno"),
 *             @OA\Property(property="pregledi_id", type="integer", example=6)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Laboratorijski nalaz uspješno azuriran"
 *     )
 * )
 */
Flight::route('PUT /labs/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new LaboratorijaService();
    $updated = $service->update($id, $data);

    if ($updated) {
        Flight::json([
            'message' => "Laboratorijski nalaz (ID: $id) je uspješno ažuriran."
        ]);
    } else {
        Flight::json([
            'message' => "Greška prilikom ažuriranja laboratorijskog nalaza (ID: $id)."
        ], 500);
    }
});
/**
 * @OA\Delete(
 *     path="/labs/{id}",
 *     tags={"Laboratorija"},
 *     summary="Delete laboratory record",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID laboratorijskog nalaza",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Laboratorijski nalaz uspješno obrisan"
 *     )
 * )
 */
Flight::route('DELETE /labs/@id', function($id) {
    $service = new LaboratorijaService();
    $deleted = $service->delete($id);

    if ($deleted) {
        Flight::json([
            'message' => "Laboratorijski nalaz (ID: $id) je uspješno obrisan iz baze."
        ]);
    } else {
        Flight::json([
            'message' => "Greška prilikom brisanja laboratorijskog nalaza (ID: $id)."
        ], 500);
    }
});