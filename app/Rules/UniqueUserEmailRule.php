<?php

namespace App\Rules;

use App\Models\User;
use App\Services\FilterClosureQueryService;
use Illuminate\Contracts\Validation\Rule;

class UniqueUserEmailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        return true;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = strtoupper($value);
        $user = request()->route('user') ?? null;
        $emailExists = User::query()
            ->where('email', $value)
            ->when($user, FilterClosureQueryService::where('id', $user->id, false))
            ->first();

        return $emailExists ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This email already exists.';
    }
}
