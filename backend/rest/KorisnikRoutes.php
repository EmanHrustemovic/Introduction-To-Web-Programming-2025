<?php

use App\dao\KorisnikDao;
use App\services\korisnikService;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});


/**
 * @OA\Get(
 *     path="/user",
 *     tags={"Korisnici"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="Lista svih korisnika."
 *     )
 * )
 */

Flight::route('GET /user',function(){

    $dao = new KorisnikDao();
    $svi_korisnici = $dao->getAllUsers();

    Flight::json($svi_korisnici);

    //RADI
});

/**
 * @OA\Get(
 *     path="/user/{id}",
 *     tags={"Korisnici"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID korisnika",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Korisnik pronađen po ID-u"
 *     )
 * )
 */

Flight::route('GET /user/@id' , function($id){

    $dao = new KorisnikDao();
    $korisnici_po_id = $dao -> getUserByID($id);
    Flight::json($korisnici_po_id);

    //RADI
});

/**
 * @OA\Post(
 *     path="/user/add",
 *     tags={"Korisnici"},
 *     summary="Add a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"id", "ime", "prezime", "email", "telefon", "password", "uloga"},
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="ime", type="string", example="Eman"),
 *             @OA\Property(property="prezime", type="string", example="Hrustemović"),
 *             @OA\Property(property="email", type="string", format="email", example="eman@example.com"),
 *             @OA\Property(property="telefon", type="string", example="+38761123456"),
 *             @OA\Property(property="password", type="string", example="password123"),
 *             @OA\Property(property="uloga", type="string", example="doktor")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Korisnik uspješno dodat"
 *     )
 * )
 */

Flight::route('POST /user/add',function (){

    $data = Flight::request()->data;

    $id = $data -> id;
    $ime = $data -> ime;
    $prezime = $data -> prezime;
    $email = $data -> email;
    $telefon = $data -> telefon;
    $password = $data -> password;
    $uloga = $data -> uloga;

    $service = new KorisnikService();
    $service->addUser($id,$ime,$prezime,$email,$telefon,$password,$uloga);

    Flight::json(['message' => 'Korisnik uspješno dodat.']);
    //RADI
});


/**
 * @OA\Put(
 *     path="/user/{id}",
 *     tags={"Korisnici"},
 *     summary="Update an existing user",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID korisnika",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="ime", type="string", example="NoviIme"),
 *             @OA\Property(property="prezime", type="string", example="NovoPrezime"),
 *             @OA\Property(property="email", type="string", format="email", example="novi@example.com"),
 *             @OA\Property(property="telefon", type="string", example="+38761234567"),
 *             @OA\Property(property="password", type="string", example="newpassword"),
 *             @OA\Property(property="uloga", type="string", example="admin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Korisnik uspješno ažuriran"
 *     )
 * )
 */

Flight::route('PUT /user/@id',function($id){

    $data = Flight::request()->data;

    $service = new KorisnikService();

    $izmjeni_korisnika = $service -> updateUser($id,$data);


    Flight::json($izmjeni_korisnika);
    //NE RADI
});


/**
 * @OA\Delete(
 *     path="/user/{id}",
 *     tags={"Korisnici"},
 *     summary="Delete user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID korisnika za brisanje",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Korisnik uspješno izbrisan"
 *     )
 * )
 */

Flight::route('DELETE /user/@id',function($id){

    $data = Flight::request()->data;

    $service = new KorisnikService();

    $ukloni_korisnika = $service -> deleteUser($id);
    Flight::json($ukloni_korisnika);

    //RADI

});