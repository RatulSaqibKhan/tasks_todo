<?php

namespace App\Http\Requests;

use App\Rules\UniqueCompanyNameRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Messages
     * 
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => "Required field",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', new UniqueCompanyNameRule()],
            'email' => 'nullable',
            'address' => 'nullable',
            'attention' => 'nullable',
            'party_type' => 'nullable',
            'phone_no' => 'nullable',
            'fax' => 'nullable',
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif|file|max:300', //Max File Size is 300 kilobytes
            'active_status' => 'nullable|integer',
        ];
    }
}
