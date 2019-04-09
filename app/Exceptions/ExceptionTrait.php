<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use function MongoDB\BSON\toJSON;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Trait ExceptionTrait
{
    public function exHandler($req,$ex)
    {
        if ($this->isHttp($ex)){
           return $this->responseHttp();
        }
        if ($this->isModel($ex)){
           return $this->responseModel();
        }
        return parent::render($req, $ex);
    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function responseModel()
    {
    return response()->json('This Model Not Found',Response::HTTP_NOT_FOUND);
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function responseHttp()
    {
      return response()->json('This Route Not Found',Response::HTTP_NOT_FOUND);
    }
}
