<?php

namespace App\Actions\Company;

use App\Http\Requests\CompanyRequest;
use App\Interfaces\ActionInterface;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CompanyUpdateAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\CompanyRequest
     */
    protected CompanyRequest $request;

    /**
     * @var App\Models\Company
     */
    protected Company $company;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\CompanyRequest
     */
    public function __construct(CompanyRequest $request, Company $company)
    {
        $this->request = $request;
        $this->company = $company;
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
            $this->company->fill($this->request->except('_token', 'logo'));
            if ($this->request->hasFile('logo')) {
                if (isset($this->company->logo)) {
                    $file_name_to_delete = $this->company->logo;
                    if ( $this->hasPrevImage($file_name_to_delete) ) {
                        Storage::delete('company_logo/' . $file_name_to_delete);
                    }
                }
                $time = time();
                $file = $this->request->logo;
                $file->storeAs('company_logo', $time . $file->getClientOriginalName());
                $this->company->logo = $time . $file->getClientOriginalName();
            }
            $this->company->save();
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
            'company' => $this->company ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }

    /**
     * @param $file_name_to_delete
     * @return bool
     */
    public function hasPrevImage($file_name_to_delete): bool
    {
        return Storage::disk('public')->exists('/company_logo/' . $file_name_to_delete) && $file_name_to_delete != null;
    }
}