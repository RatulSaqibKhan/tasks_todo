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
            $form = view('users.form', [
                'user' => $this->user ?? null,
                'companies' => $companies,
                'roles' => $roles,
            ])->render();
            
            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \DATA_FETCHED_SUCCESS_MSG;
            $status = Response::HTTP_OK;
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'title' => "New User",
            'view' => $form ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
        ];
    }
}