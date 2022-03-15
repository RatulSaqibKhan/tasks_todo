<?php

namespace App\Rules;

use App\Models\Client;
use App\Services\FilterClosureQueryService;
use Illuminate\Contracts\Validation\Rule;

class UniqueClientNameRule implements Rule
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
        $client = request()->route('client') ?? null;
        $clientId = $client ? $client->id : null;
        $emailExists = Client::query()
            ->where('name', $value)
            ->where('company_id', request()->get('company_id'))
            ->when($client, FilterClosureQueryService::where('id', $clientId, false))
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
        return 'This name already exists.';
    }
}
