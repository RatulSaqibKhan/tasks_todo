<?php

namespace App\Actions\Company;

use App\Interfaces\ActionInterface;
use App\Models\Company;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CompanyFormViewRenderAction implements ActionInterface
{
    /**
     * @var null|object
     */
    protected $company;

    /**
     * Constructor
     * 
     * @param null|App\Models\Company
     */
    public function __construct(Company $company = null)
    {
        $this->company = $company;
    }

    /**
     * Form Viewer
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $form = view('companies.form', [
                'company' => $this->company ?? null,
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
            'title' => "New Company",
            'view' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}