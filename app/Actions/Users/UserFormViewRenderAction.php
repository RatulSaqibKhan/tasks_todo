<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserFormViewRenderAction implements ActionInterface
{
    /**
     * @var null|object
     */
    protected $user;

    /**
     * Constructor
     * 
     * @param null|App\Models\User
     */
    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * Form Viewer
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $companies = Company::pluck('name', 'id')->all();
            $roles = Role::pluck('name', 'id')->all();
            $company_ids = $this->user && $this->user->companyUserMappings->count() ? $this->user->companyUserMappings->pluck('company_id')->toArray() : null;
            $role_id = $this->user && $this->user->userRoleMappings->count() ? $this->user->userRoleMappings->first()->role_id : null;
            $form = view('users.form', [
                'user' => $this->user ?? null,
                'companies' => $companies,
                'roles' => $roles,
                'role_id' => $role_id,
                'company_ids' => $company_ids,
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
            'title' => $this->user ? "Update User" : "New User",
            'view' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}