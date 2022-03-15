<?php

namespace App\Actions\JobType;

use App\Interfaces\ActionInterface;
use App\Models\JobType;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class JobTypeDestroyAction implements ActionInterface
{
    /**
     * @var App\Models\JobType 
     */
    protected JobType $jobType;

    /**
     * Constructor
     * 
     * @param App\Models\JobType
     */
    public function __construct(JobType $jobType)
    {
        $this->jobType = $jobType;
    }

    /**
     * Delete jobType
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $this->jobType->delete();
            
            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \DELETE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
            $iconClass = 'bx bxs-message-square-check';
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $iconClass = 'bx bxs-message-square-error';
        }

        return [
            'job_type' => $this->jobType ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}