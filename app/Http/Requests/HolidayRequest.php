<?php

namespace App\Http\Requests;

use App\Rules\UniqueHolidayRule;
use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
            'date' => "Invalid data given",
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
            'holiday' => ['required', 'date', new UniqueHolidayRule()],
            'company_id' => 'required|integer',
        ];
    }
}
