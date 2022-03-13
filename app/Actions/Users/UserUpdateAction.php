<?php

namespace App\Actions\Users;

use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateAction implements ActionInterface
{
    /**
     * @var object
     */
    protected object $user;
    
    /**
     * @var App\Http\Requests\UserUpdateRequest
     */
    protected UserUpdateRequest $request;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\UserUpdateRequest
     * @param App\Models\User
     */
    public function __construct(UserUpdateRequest $request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Update existing user
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            DB::beginTransaction();
            $this->user->fill($this->request->except('_token', '_method'));
            $this->user->save();
            if ($this->request->role_id) {
                $userRoleAssignResponse = (new UserRoleAssignAction($this->user, $this->request->role_id))->action();
            }
            if ($this->request->company_id && \is_array($this->request->company_id) && count($this->request->company_id)) {
                $companyUserMapping = (new CompanyUserAssignAction($this->user, $this->request->company_id))->action();
            }
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
            'user' => $this->user ?? null,
            'userRoleAssignResponse' => $userRoleAssignResponse ?? null,
            'companyUserMapping' => $companyUserMapping ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}