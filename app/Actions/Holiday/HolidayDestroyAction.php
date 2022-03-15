<?php

namespace App\Actions\Holiday;

use App\Interfaces\ActionInterface;
use App\Models\Holiday;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class HolidayDestroyAction implements ActionInterface
{
    /**
     * @var App\Models\Holiday 
     */
    protected Holiday $holiday;

    /**
     * Constructor
     * 
     * @param App\Models\Holiday
     */
    public function __construct(Holiday $holiday)
    {
        $this->holiday = $holiday;
    }

    /**
     * Delete holiday
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $this->holiday->delete();
            
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
            'holiday' => $this->holiday ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}