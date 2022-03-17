<?php

namespace App\Rules;

use App\Models\Template;
use App\Services\FilterClosureQueryService;
use Illuminate\Contracts\Validation\Rule;

class UniqueTemplateRule implements Rule
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
        $template = request()->route('template') ?? null;
        $templateId = $template ? $template->id : null;
        $exists = Template::query()
            ->where('name', $value)
            ->where('job_type_id', request()->get('job_type_id'))
            ->where('company_id', request()->get('company_id'))
            ->when($template, FilterClosureQueryService::where('id', $templateId, false))
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
