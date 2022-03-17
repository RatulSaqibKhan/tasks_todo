<?php

namespace App\Actions\Template;

use App\Interfaces\ActionInterface;
use App\Models\Template;
use App\Services\FilterClosureQueryService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TemplateSearchSelectAction implements ActionInterface
{
    /**
     * @var object
     */
    protected $request;

    /**
     * Constructor
     * 
     * @param Illuminate\Http\Request;
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Form Viewer
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $q = $this->request->q ?? null;
            $company_id = $this->request->company_id ?? null;
            $job_type_id = $this->request->job_type_id ?? null;
            $data = Template::query()
                ->select('id', 'name')
                ->when($q, FilterClosureQueryService::whereLike('name', $q))
                ->when($company_id, FilterClosureQueryService::where('company_id', $company_id))
                ->when($job_type_id, FilterClosureQueryService::where('job_type_id', $job_type_id))
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'text' => $item->name,
                    ];
                });

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
            'data' => $data ?? [],
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}
