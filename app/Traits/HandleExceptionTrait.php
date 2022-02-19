<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait HandleExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($this->isModel($e)) {
            return $this->modelNotFoundResponse();
        }

        if ($this->isHttp($e)) {
            return $this->httpNotFoundResponse();
        }

        return parent::render($request, $e);
    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function modelNotFoundResponse()
    {
        return response()->json(['errors' => 'Product Model Not Found'], Response::HTTP_NOT_FOUND);
    }

    protected function httpNotFoundResponse()
    {
        return response()->json(['errors' => 'Invalid Route, Please check your routes !'], Response::HTTP_NOT_FOUND);
    }
}
