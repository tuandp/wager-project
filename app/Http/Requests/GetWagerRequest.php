<?php

namespace App\Http\Requests;

use App\Exceptions\UnprocessableEntityException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class GetWagerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'limit' => 'nullable|integer|min:1|max:20',
            'page' => 'nullable|integer|min:0',
        ];
    }

    /**
     * @throws UnprocessableEntityException
     */
    public function failedValidation(Validator $validator)
    {
        throw new UnprocessableEntityException($validator);
    }
}
