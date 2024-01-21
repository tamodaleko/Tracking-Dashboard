<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyKeysRequest extends FormRequest
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
            'provider' => ['required', 'string'],
            'sp_api_key' => ['nullable', 'string'],
            'fb_app_id' => ['nullable', 'string'],
            'fb_app_secret' => ['nullable', 'string'],
            'fb_access_token' => ['nullable', 'string'],
            'fb_ad_account_id' => ['nullable', 'string'],
            'sf_webhook_secret' => ['nullable', 'string']
        ];
    }
}
