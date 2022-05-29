<?php

namespace App\Http\Requests;

use App\Exceptions\UnprocessableEntityException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BuyWagerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'buying_price' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($value > $this->route('wager')->current_selling_price) {
                        $fail('The buying price field is invalid.');
                    }
                },
            ],
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
