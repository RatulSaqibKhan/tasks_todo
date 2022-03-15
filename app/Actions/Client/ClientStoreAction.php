<?php

namespace App\Actions\Client;

use App\Http\Requests\ClientRequest;
use App\Interfaces\ActionInterface;
use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ClientStoreAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\ClientRequest
     */
    protected ClientRequest $request;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\ClientRequest
     */
    public function __construct(ClientRequest $request)
    {
        $this->request = $request;
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
            $client = new Client();
            $client->fill($this->request->except('_token'));
            $client->save();
            DB::commit();

            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \SAVE_SUCCESS_MSG;
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
            'client' => $client ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}