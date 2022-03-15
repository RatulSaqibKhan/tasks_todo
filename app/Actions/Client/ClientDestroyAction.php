<?php

namespace App\Actions\Client;

use App\Interfaces\ActionInterface;
use App\Models\Client;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ClientDestroyAction implements ActionInterface
{
    /**
     * @var App\Models\Client 
     */
    protected Client $client;

    /**
     * Constructor
     * 
     * @param App\Models\Client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Delete client
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $this->client->delete();
            
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
            'client' => $this->client ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}