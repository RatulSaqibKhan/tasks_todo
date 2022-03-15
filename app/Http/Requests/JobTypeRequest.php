<?php

namespace App\Http\Requests;

use App\Rules\UniqueJobTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class JobTypeRequest extends FormRequest
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
            'integer' => "Invalid data given",
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
            'name' => ['required', new UniqueJobTypeRule()],
            'company_id' => 'required|integer',
            'active_status' => 'nullable',
        ];
    }
}
