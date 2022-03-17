<?php

namespace App\Actions\Client;

use App\Http\Requests\ClientRequest;
use App\Interfaces\ActionInterface;
use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ClientUpdateAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\ClientRequest
     */
    protected ClientRequest $request;

    /**
     * @var App\Models\Client
     */
    protected Client $client;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\ClientRequest
     */
    public function __construct(ClientRequest $request, Client $client)
    {
        $this->request = $request;
        $this->client = $client;
    }

    /**
     * Store new Client, set role and assign to multiple factories
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            DB::beginTransaction();
            $this->client->fill($this->request->except('_token'));
            $this->client->save();
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
            'client' => $this->client ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}