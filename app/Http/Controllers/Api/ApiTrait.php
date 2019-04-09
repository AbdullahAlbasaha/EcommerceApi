<?php

namespace App\Http\Controllers\Api;

trait ApiTrait
{
    public function apiResponse($data = null ,$errors = null,$code = 200)
    {
        $response = [
            'data'=>$data,
            'errors'=>!$errors?'no errors':$errors,
            'status'=>!$errors?:false,
        ];
        return response($response,$code);
    }
}
