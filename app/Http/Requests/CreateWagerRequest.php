<?php

namespace App\Http\Requests;

use App\Exceptions\UnprocessableEntityException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Carbon;

class CreateWagerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_wager_value' => 'required|integer|min:0',
            'odds' => 'required|integer|min:0',
            'selling_percentage' => 'required|integer|min:0',
            'selling_price' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($value <= ($this->input('total_wager_value') / ($this->input('selling_percentage') * 100))) {
                        $fail('The selling price field is invalid.');
                    }
                },
            ],
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'current_selling_price' => $this->input('selling_price'),
            'placed_at' => Carbon::now(),
        ]);
    }

    /**
     * @throws UnprocessableEntityException
     */
    public function failedValidation(Validator $validator)
    {
       throw new UnprocessableEntityException($validator);
    }
}
