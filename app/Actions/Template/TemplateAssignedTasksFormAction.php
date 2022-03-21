<?php

namespace App\Actions\Template;

use App\Interfaces\ActionInterface;
use App\Models\TemplateTasksMapping;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TemplateAssignedTasksFormAction implements ActionInterface
{
    /**
     * @var object
     */
    protected $request;

    /**
     * Constructor
     * 
     * @param Illuminate\Http\Request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Form Viewer
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $template_id = $this->request->template_id;
            $templateTasks = TemplateTasksMapping::query()->where('template_id', $template_id)->get();
            $form = view('templates.assigned_tasks_form', [
                'template_tasks' => $templateTasks ?? null,
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
            'form' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}