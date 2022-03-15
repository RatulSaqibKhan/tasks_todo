<?php

namespace App\Rules;

use App\Models\JobType;
use App\Services\FilterClosureQueryService;
use Illuminate\Contracts\Validation\Rule;

class UniqueJobTypeRule implements Rule
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
        $jobType = request()->route('job_type') ?? null;
        $jobTypeId = $jobType ? $jobType->id : null;
        $exists = JobType::query()
            ->where('name', $value)
            ->where('company_id', request()->get('company_id'))
            ->when($jobType, FilterClosureQueryService::where('id', $jobTypeId, false))
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
