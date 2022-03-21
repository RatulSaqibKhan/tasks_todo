<?php

namespace App\Actions\Template;

use App\Interfaces\ActionInterface;
use App\Models\Company;
use App\Models\Template;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TemplateAssignTasksInitAction implements ActionInterface
{
    /**
     * Fetch Template Data
     * 
     * @return array
     */
    public function action(): array
    {
        $companies = Company::query()->pluck('name', 'id');
        $taskCompletionBasis = TASK_COMPLETION_BASIS;

        return [
            'companies' => $companies ?? [],
            'task_completion_basis_options' => $taskCompletionBasis ?? [],
        ];
    }
}