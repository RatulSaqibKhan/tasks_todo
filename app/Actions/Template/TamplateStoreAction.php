<?php

namespace App\Actions\Template;

use App\Http\Requests\TemplateRequest;
use App\Interfaces\ActionInterface;
use App\Models\Template;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TemplateStoreAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\TemplateRequest
     */
    protected TemplateRequest $request;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\TemplateRequest
     */
    public function __construct(TemplateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Store new Template, set role and assign to multiple factories
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            DB::beginTransaction();
            $template = new Template();
            $template->fill($this->request->except('_token'));
            $template->save();
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
            'template' => $template ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}