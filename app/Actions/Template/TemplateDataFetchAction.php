<?php

namespace App\Actions\Template;

use App\Interfaces\ActionInterface;
use App\Models\Template;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TemplateDataFetchAction implements ActionInterface
{
    /**
     * Fetch Template Data
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $data = Template::query()->orderBy('id', 'desc')->paginate();
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
            'templates' => $data ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}