<?php


require_once __DIR__ . '/../dao/LaboratorijaDao.php';
require_once __DIR__ . '/../services/laboratorijaService.php';

use App\dao\LaboratorijaDao;
use App\services\laboratorijaService;

Flight::route('GET /connection-check' ,function(){
    
    /*
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;
    */

});


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

Flight::route('GET /labs',function(){

    $dao = new LaboratorijaDao();
    $laboratorija = $dao->pregledLaboratorije();

    Flight::json($laboratorija);

    //RADI

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

Flight::route('GET /labs/@id',function($id){

    $dao = new LaboratorijaDao();
    $lab = $dao -> laboratorijaPoId($id);
    Flight::json($lab);
//RADI
});


/**
 * @OA\Post(
 *     path="/labs/add",
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

Flight::route('POST /labs/add', function() {
    $data = Flight::request()->data;

    $sifraNalaza = $data->sifraNalaza;
    $tipNalaza = $data->tipNalaza;
    $vrsta_uzorka = $data->vrsta_uzorka;
    $datum_obrade = $data->datum_obrade;
    $status = $data->status;
    $pregledi_id = $data->pregledi_id;

    $service = new laboratorijaService();
    $new_lab = $service->addLaboratory($sifraNalaza, $tipNalaza, $vrsta_uzorka, $datum_obrade, $status, $pregledi_id);

    Flight::json(["success" => true]);

    //RADI
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

    $data = Flight::request()->data;
    //var_dump(Flight::request()->data);

    $service = new laboratorijaService();
    $update_lab = $service->updateLaboratory($id, $data);

    Flight::json($update_lab);

    //RADI
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

Flight::route('DELETE /labs/@id',function($id){

    // RADI

    $message = "";

    $service = new laboratorijaService();

    $delete_lab = $service-> deleteLaboratory($id);

    if ($delete_lab) {
        $message =  "Laboratorijski podatci su uspješno izbrisani iz baze.";
    } else {
        $message = "Laboratorijski podatci nisu uspješno izbrisani iz baze.";
    }
    print($message);

    //RADI
});
