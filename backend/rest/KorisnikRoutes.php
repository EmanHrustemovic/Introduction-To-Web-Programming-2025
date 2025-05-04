<?php

require_once __DIR__ . '/../dao/KorisnikDao.php';
use App\dao\KorisnikDao;

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
Flight::route('GET /user', function() {
    Flight::json(Flight::korisnik_service()->getAll());
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
Flight::route('GET /user/@id', function($id) {
    $one = Flight::korisnik_service()->getById($id);
    Flight::json($one ?: [], $one ? 200 : 404);
});

/**
 * @OA\Post(
 *     path="/user",
 *     tags={"Korisnici"},
 *     summary="Add a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"ime","prezime","email","telefon","password","uloga"},
 *             @OA\Property(property="ime", type="string", example="Eman"),
 *             @OA\Property(property="prezime", type="string", example="Hrustemović"),
 *             @OA\Property(property="email", type="string", format="email", example="eman@example.com"),
 *             @OA\Property(property="telefon", type="string", example="+38761123456"),
 *             @OA\Property(property="password", type="string", example="password123"),
 *             @OA\Property(property="uloga", type="string", example="doktor")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Korisnik uspješno dodat"
 *     )
 * )
 */
Flight::route('POST /user', function() {
    $data = Flight::request()->data->getData();
    $created = Flight::korisnik_service()->create($data);
    Flight::json($created, 201);
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
Flight::route('PUT /user/@id', function($id) {
    $data = Flight::request()->data->getData();
    $updated = Flight::korisnik_service()->update($id, $data);
    Flight::json($updated ? ['message'=>'Ažurirano'] : ['message'=>'Ne postoji'], $updated ? 200 : 404);
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
Flight::route('DELETE /user/@id', function($id) {
    $deleted = Flight::korisnik_service()->delete($id);
    Flight::json($deleted ? ['message'=>'Korisnik izbrisan'] : ['message'=>'Ne postoji'], $deleted ? 200 : 404);
});