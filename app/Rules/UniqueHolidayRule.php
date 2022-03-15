<?php

namespace App\Rules;

use App\Models\Holiday;
use App\Services\FilterClosureQueryService;
use Illuminate\Contracts\Validation\Rule;

class UniqueHolidayRule implements Rule
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
        $holiday = request()->route('holiday') ?? null;
        $holidayId = $holiday ? $holiday->id : null;
        $exists = Holiday::query()
            ->where('holiday', $value)
            ->where('company_id', request()->get('company_id'))
            ->when($holiday, FilterClosureQueryService::where('id', $holidayId, false))
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
        return 'This date already exists.';
    }
}
