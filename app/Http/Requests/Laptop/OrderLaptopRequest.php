<?php

namespace App\Http\Requests\Laptop;

use Illuminate\Foundation\Http\FormRequest;

class OrderLaptopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'color' => ['required', 'string', 'max:255'],
            'address1' => ['required', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:2'],
            'zip' => ['required', 'integer'],
            'country' => ['required', 'string', 'max:2'],
            'payment_method' => ['required', 'string', 'max:255'],
            'screen' => ['required', 'string'],
            'warranty' => ['nullable', 'integer'],
            'warranty_years' => ['required', 'integer'],
            'warranty_protection' => ['required', 'integer']
        ];
    }
}
