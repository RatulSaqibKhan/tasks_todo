<?php

namespace App\Rules;

use App\Models\Company;
use App\Services\FilterClosureQueryService;
use Illuminate\Contracts\Validation\Rule;

class UniqueCompanyNameRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        return auth()->check();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $value = strtoupper($value);
        $company = request()->route('company') ?? null;
        $companyId = $company ? $company->id : null;
        $exists = Company::query()
            ->where('name', $value)
            ->when($company, FilterClosureQueryService::where('id', $companyId, false))
            ->first();

        return $exists ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'This name already exists.';
    }
}
