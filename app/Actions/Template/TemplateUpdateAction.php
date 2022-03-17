<?php

namespace App\Actions\Template;

use App\Http\Requests\TemplateRequest;
use App\Interfaces\ActionInterface;
use App\Models\Template;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TemplateUpdateAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\TemplateRequest
     */
    protected TemplateRequest $request;

    /**
     * @var App\Models\Template
     */
    protected Template $template;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\TemplateRequest
     */
    public function __construct(TemplateRequest $request, Template $template)
    {
        $this->request = $request;
        $this->template = $template;
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
            $this->template->fill($this->request->except('_token'));
            $this->template->save();
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
            'template' => $this->template ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}