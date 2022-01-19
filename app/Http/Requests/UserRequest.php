<?php

namespace App\Http\Requests;

use App\Rules\UniqueUserEmailRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function messages()
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
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', new UniqueUserEmailRule()],
            'designation' => 'nullable',
            'phone_no' => 'nullable',
            'address' => 'nullable',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8,same:password',
        ];
    }
}
