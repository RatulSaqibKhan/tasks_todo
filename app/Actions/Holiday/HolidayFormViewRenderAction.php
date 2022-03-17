<?php

namespace App\Actions\Holiday;

use App\Interfaces\ActionInterface;
use App\Models\Company;
use App\Models\Holiday;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class HolidayFormViewRenderAction implements ActionInterface
{
    /**
     * @var null|object
     */
    protected $holiday;

    /**
     * Constructor
     * 
     * @param null|App\Models\Holiday
     */
    public function __construct(Holiday $holiday = null)
    {
        $this->holiday = $holiday;
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
            $form = view('holidays.form', [
                'holiday' => $this->holiday ?? null,
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
            'title' => $this->holiday ? "Update Holiday": "New Holiday",
            'view' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}