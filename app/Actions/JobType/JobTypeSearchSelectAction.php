<?php

namespace App\Actions\JobType;

use App\Interfaces\ActionInterface;
use App\Models\JobType;
use App\Services\FilterClosureQueryService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobTypeSearchSelectAction implements ActionInterface
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
            $data = JobType::query()
                ->select('id', 'name')
                ->where('active_status', \ACTIVE)
                ->when($q, FilterClosureQueryService::whereLike('name', $q))
                ->when($company_id, FilterClosureQueryService::where('company_id', $company_id))
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
