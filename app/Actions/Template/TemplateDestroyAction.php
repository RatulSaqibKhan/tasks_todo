<?php

namespace App\Actions\Template;

use App\Interfaces\ActionInterface;
use App\Models\Template;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TemplateDestroyAction implements ActionInterface
{
    /**
     * @var App\Models\Template 
     */
    protected Template $template;

    /**
     * Constructor
     * 
     * @param App\Models\Template
     */
    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    /**
     * Delete template
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $this->template->delete();
            
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
            'template' => $this->template ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}