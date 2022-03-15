<?php

namespace App\Actions\Client;

use App\Interfaces\ActionInterface;
use App\Models\Client;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ClientDataFetchAction implements ActionInterface
{
    /**
     * Fetch Client Data
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $data = Client::query()->orderBy('id', 'desc')->paginate();
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
            'clients' => $data ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}