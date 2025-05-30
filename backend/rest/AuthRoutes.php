<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group('/auth', function() {
   /**
    * @OA\Post(
    *     path="/auth/register",
    *     summary="Register new user.",
    *     description="Dodaj korisnika u bazu podataka.",
    *     tags={"auth"},
    *     security={
    *         {"ApiKey": {}}
    *     },
    *     @OA\RequestBody(
    *         description="Dodaj novog korisnika",
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 required={"password", "email"},
    *                 @OA\Property(
    *                     property="password",
    *                     type="string",
    *                     example="neki_password",
    *                     description="Korisnikov password"
    *                 ),
    *                 @OA\Property(
    *                     property="email",
    *                     type="string",
    *                     example="demo@gmail.com",
    *                     description="Korisnikov email"
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Korisnik dodan na sistem."
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Greška u sistemu."
    *     )
    * )
    */
   Flight::route("POST /register", function () {
       $data = Flight::request()->data->getData();


       $response = Flight::auth_service()->register($data);
  
       if ($response['success']) {
           Flight::json([
               'message' => 'Korisnik uspiješno registrovan',
               'data' => $response['data']
           ]);
       } else {
           Flight::halt(500, $response['error']);
       }
   });
   /**
    * @OA\Post(
    *      path="/auth/login",
    *      tags={"auth"},
    *      summary="Ulazak na aplikaciju pomoću email-a i passworda",
    *      @OA\Response(
    *           response=200,
    *           description="Korisnički podatci i  JWT."
    *      ),
    *      @OA\RequestBody(
    *          description="Akreditacije",
    *          @OA\JsonContent(
    *              required={"email","password"},
    *              @OA\Property(property="email", type="string", example="demo@gmail.com", description="Student email address"),
    *              @OA\Property(property="password", type="string", example="some_password", description="Student password")
    *          )
    *      )
    * )
    */
   Flight::route('POST /login', function() {
       $data = Flight::request()->data->getData();


       $response = Flight::auth_service()->login($data);
  
       if ($response['success']) {
           Flight::json([
               'message' => 'Korisnik uspiješno logovan',
               'data' => $response['data']
           ]);
       } else {
           Flight::halt(500, $response['error']);
       }
   });
});
?>