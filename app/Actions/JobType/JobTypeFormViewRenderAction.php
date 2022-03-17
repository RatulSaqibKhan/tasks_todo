<?php

namespace App\Actions\JobType;

use App\Interfaces\ActionInterface;
use App\Models\Company;
use App\Models\JobType;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class JobTypeFormViewRenderAction implements ActionInterface
{
    /**
     * @var null|object
     */
    protected $jobType;

    /**
     * Constructor
     * 
     * @param null|App\Models\JobType
     */
    public function __construct(JobType $jobType = null)
    {
        $this->jobType = $jobType;
    }

    /**
     * Form Viewer
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $companies = Company::query()->pluck('name', 'id');
            $form = view('job-types.form', [
                'job_type' => $this->jobType ?? null,
                'companies' => $companies
            ])->render();
            
            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \DATA_FETCHED_SUCCESS_MSG;
            $status = Response::HTTP_OK;
            $iconClass = 'bx bxs-message-square-check';
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $iconClass = 'bx bxs-message-square-error';
        }

        return [
            'title' => $this->jobType ? "Update Job Type": "New Job Type",
            'view' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}