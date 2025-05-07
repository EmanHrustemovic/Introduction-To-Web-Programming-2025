<?php
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Moje Zdravlje API",
 *         description="API za upravljanje pacijentima, pregledima i laboratorijskim nalazima",
 *         version="1.0",
 *         @OA\Contact(
 *             email="eman.hrustemovic.stu@ibu.edu.ba",
 *             name="Eman Hrustemović"
 *         )
 *     ),
 *     @OA\Server(
 *         url="http://backend.app",
 *         description="API server"
 *     ),
 *     @OA\Components(
 *         @OA\SecurityScheme(
 *             securityScheme="ApiKey",
 *             type="apiKey",
 *             in="header",
 *             name="Authentication"
 *         )
 *     )
 * )
 */