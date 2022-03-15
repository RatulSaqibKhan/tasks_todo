<?php

namespace App\Actions\Holiday;

use App\Interfaces\ActionInterface;
use App\Models\Holiday;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class HolidayDataFetchAction implements ActionInterface
{
    /**
     * Fetch Holiday Data
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $data = Holiday::query()->orderBy('id', 'desc')->paginate();
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
            'holidays' => $data ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}