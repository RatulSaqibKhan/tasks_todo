<?php

namespace App\Actions\Company;

use App\Http\Requests\CompanyRequest;
use App\Interfaces\ActionInterface;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CompanyStoreAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\CompanyRequest
     */
    protected CompanyRequest $request;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\CompanyRequest
     */
    public function __construct(CompanyRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Store new Company, set role and assign to multiple factories
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            DB::beginTransaction();
            $company = new Company();
            $company->fill($this->request->except('_token', 'logo'));
            if ($this->request->hasFile('logo')) {
                $time = time();
                $file = $this->request->logo;
                $file->storeAs('company_logo', $time . $file->getClientOriginalName());
                $company->logo = $time . $file->getClientOriginalName();
            }
            $company->save();
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
            'company' => $company ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}