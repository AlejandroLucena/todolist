<?php

namespace App\Http\Controllers;

use Modules\Shared\Infrastructure\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Swagger with Laravel",
 *    version="1.0.0",
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )

 */
class Controller extends BaseController
{
}
