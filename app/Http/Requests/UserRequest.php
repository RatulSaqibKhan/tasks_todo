<?php

namespace App\Http\Requests;

use App\Rules\UniqueUserEmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', new UniqueUserEmailRule()],
            'designation' => 'nullable',
            'phone_no' => 'nullable',
            'address' => 'nullable',
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'confirm_password' => 'required|same:password',
            'role_id' => 'required',
            'company_id' => 'nullable|array',
            'company_id.*' => 'nullable'
        ];
    }
}
