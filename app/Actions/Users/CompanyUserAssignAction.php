<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\CompanyUserMapping;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CompanyUserAssignAction implements ActionInterface
{
    /**
     * @var object
     */
    protected object $user;

    /**
     * @var array
     */
    protected array $company_ids;

    /**
     * Constructor of CompanyUserAssignAction
     * 
     * @param App\Models\User
     * @param array $company_ids
     * 
     */
    public function __construct(User $user, array $company_ids)
    {
        $this->user = $user;
        $this->company_ids = $company_ids;
    }

    /**
     * Assign user to multiple companies
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            CompanyUserMapping::where('user_id', $this->user->id)->forceDelete();
            $companyUserMappings = [];
            foreach ($this->company_ids as $company_id) {
                $companyUserMapping = new CompanyUserMapping();
                $companyUserMapping->user_id = $this->user->id;
                $companyUserMapping->company_id = $company_id;
                $companyUserMapping->save();
                $companyUserMappings[] = $companyUserMapping;
            }
            

            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \SAVE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'companyUserMappings' => $companyUserMappings ?? [],
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
        ];
    }
}