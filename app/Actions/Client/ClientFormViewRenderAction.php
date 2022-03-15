<?php

namespace App\Actions\Client;

use App\Interfaces\ActionInterface;
use App\Models\Client;
use App\Models\Company;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ClientFormViewRenderAction implements ActionInterface
{
    /**
     * @var null|object
     */
    protected $client;

    /**
     * Constructor
     * 
     * @param null|App\Models\Client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client;
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
            $form = view('clients.form', [
                'client' => $this->client ?? null,
                'companies' => $companies ?? []
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
            'title' => "New Client",
            'view' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}