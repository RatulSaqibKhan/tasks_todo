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
        $user = request()->route('user') ?? null;
        $userId = $user ? $user->id : null;
        $emailExists = User::query()
            ->where('email', $value)
            ->when($user, FilterClosureQueryService::where('id', $userId, false))
            ->first();

        return $emailExists ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'This email already exists.';
    }
}
