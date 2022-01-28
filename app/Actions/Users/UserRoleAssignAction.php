<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\User;
use App\Models\UserRoleMapping;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserRoleAssignAction implements ActionInterface
{
    protected $user, $role_id;

    public function __construct(User $user, $role_id)
    {
        $this->user = $user;
        $this->role_id = $role_id;
    }

    public function action()
    {
        try {
            $userRoleMapping = UserRoleMapping::firstOrNew(['user_id' => $this->user->id]);
            $userRoleMapping->user_id = $this->user->id;
            $userRoleMapping->role_id = $this->role_id;
            $userRoleMapping->save();

            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \SAVE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'userRoleMapping' => $userRoleMapping ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
        ];
    }
}