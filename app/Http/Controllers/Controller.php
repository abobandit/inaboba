<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\ResponseFactory;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dataResponse( $message, int|string $status,bool $success = true) : JsonResponse
    {
        return response()->json([
            'status' => $success,
            'data' => $message
        ], $status);
    }

}
