<?php

namespace App\Actions\JobType;

use App\Http\Requests\JobTypeRequest;
use App\Interfaces\ActionInterface;
use App\Models\JobType;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class JobTypeUpdateAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\JobTypeRequest
     */
    protected JobTypeRequest $request;

    /**
     * @var App\Models\JobType
     */
    protected JobType $jobType;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\JobTypeRequest
     */
    public function __construct(JobTypeRequest $request, JobType $jobType)
    {
        $this->request = $request;
        $this->jobType = $jobType;
    }

    /**
     * Store new JobType, set role and assign to multiple factories
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            DB::beginTransaction();
            $this->jobType->fill($this->request->except('_token'));
            $this->jobType->save();
            DB::commit();

            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \UPDATE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
            $iconClass = 'bx bxs-message-square-check';
        } catch (Exception $e) {
            DB::rollBack();
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