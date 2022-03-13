<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\User;
use App\Models\UserRoleMapping;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserRoleAssignAction implements ActionInterface
{
    /**
     * @var object
     */
    protected object $user;

    /**
     * @var int
     */
    protected int $role_id;

    /**
     * Constructor
     * 
     * @param App\Models\User
     * @param int
     */
    public function __construct(User $user, int $role_id)
    {
        $this->user = $user;
        $this->role_id = $role_id;
    }

    /**
     * Set user role
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            $userRoleMapping = UserRoleMapping::firstOrNew(['user_id' => $this->user->id]);
            $userRoleMapping->user_id = $this->user->id;
            $userRoleMapping->role_id = $this->role_id;
            $userRoleMapping->save();

            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \SAVE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
            $iconClass = 'bx bxs-message-square-check';
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $iconClass = 'bx bxs-message-square-error';
        }

        return [
            'userRoleMapping' => $userRoleMapping ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}