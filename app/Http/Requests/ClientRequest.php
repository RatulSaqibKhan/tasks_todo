<?php

namespace App\Http\Requests;

use App\Rules\UniqueClientNameRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'integer' => "Invalid input given",
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
            'company_id' => 'required|integer',
            'name' => ['required', new UniqueClientNameRule()],
            'email' => 'nullable',
            'address' => 'nullable',
            'attention' => 'nullable',
            'party_type' => 'nullable',
            'phone_no' => 'nullable',
            'fax' => 'nullable',
            'active_status' => 'nullable|integer',
        ];
    }
}
