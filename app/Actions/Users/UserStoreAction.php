<?php

namespace App\Actions\Users;

use App\Http\Requests\UserRequest;
use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserStoreAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\UserRequest
     */
    protected UserRequest $request;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\UserRequest
     */
    public function __construct(UserRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Store new User, set role and assign to multiple factories
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $this->request->name;
            $user->email = $this->request->email;
            $user->designation = $this->request->designation;
            $user->phone_no = $this->request->phone_no;
            $user->address = $this->request->address;
            $user->password = bcrypt($this->request->password);
            $user->save();
            if ($this->request->role_id) {
                $userRoleAssignResponse = (new UserRoleAssignAction($user, $this->request->role_id))->action();
            }
            if ($this->request->company_id && \is_array($this->request->company_id) && count($this->request->company_id)) {
                $companyUserMapping = (new CompanyUserAssignAction($user, $this->request->company_id))->action();
            }
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
            'user' => $user ?? null,
            'userRoleAssignResponse' => $userRoleAssignResponse ?? null,
            'companyUserMapping' => $companyUserMapping ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}