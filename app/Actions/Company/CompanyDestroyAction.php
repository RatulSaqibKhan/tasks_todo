<?php

namespace App\Actions\Company;

use App\Interfaces\ActionInterface;
use App\Models\Company;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CompanyDestroyAction implements ActionInterface
{
    /**
     * @var App\Models\Company 
     */
    protected Company $company;

    /**
     * Constructor
     * 
     * @param App\Models\Company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Delete company
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $this->company->delete();
            
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
            'company' => $this->company ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}