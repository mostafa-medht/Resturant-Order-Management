<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse ;

trait StandardRessponse
{
    public function returnSuccessResponse(string $message = '',int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message
        ], $code);
    }

    public function returnErrorResponse(string $message = '',int $code = 422): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }

    function returnResponse($data = null, $message = [], $errors = [], $statusCode = 200)
    {
        if ($data !== null) {
            return response()->json(['data' => $data, 'message' => $message, 'errors' => $errors], $statusCode);
        }
        return response()->json(['data' => (object)[], 'message' => $message, 'errors' => $errors], $statusCode);
    }

    function returnCustomValidationError($msg, $errors)
    {
        $allErrors = [];

        foreach ($errors->toArray() as $key => $error){

            foreach ($error as $index => $singleError){
                $allErrors[$index]['field'] = $key;
                $allErrors[$index]['message'] = $error[0];
            }
        }

//        $customErrors = [];
//
//        foreach ($allErrors as $customError){
//            $customErrors[] = $customError;
//        }

        return response()->json([
            'status' => false,
            'errors' => $allErrors,
        ],422);
    }
}
