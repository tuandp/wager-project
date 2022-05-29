<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UnprocessableEntityException extends Exception
{
    public function __construct(public Validator $validator)
    {
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => $this->validator->errors()->first(),
        ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
