<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserStoreAction implements ActionInterface
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function action()
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
        } catch (Exception $e) {
            DB::rollBack();
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'user' => $user ?? null,
            'userRoleAssignResponse' => $userRoleAssignResponse ?? null,
            'companyUserMapping' => $companyUserMapping ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
        ];
    }
}