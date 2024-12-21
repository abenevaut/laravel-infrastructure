<?php

namespace abenevaut\Infrastructure\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class ApiFormRequestAbstract extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(['errors' => $validator->errors()], 400);

        throw new HttpResponseException($response);
    }
}
