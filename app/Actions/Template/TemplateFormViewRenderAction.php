<?php

namespace App\Actions\Template;

use App\Interfaces\ActionInterface;
use App\Models\Company;
use App\Models\Template;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TemplateFormViewRenderAction implements ActionInterface
{
    /**
     * @var null|object
     */
    protected $template;

    /**
     * Constructor
     * 
     * @param null|App\Models\Template
     */
    public function __construct(Template $template = null)
    {
        $this->template = $template;
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
            $form = view('templates.form', [
                'template' => $this->template ?? null,
                'companies' => $companies
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
            'title' => $this->template ? "Update Template" : "New Template",
            'view' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}