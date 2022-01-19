<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserDestroyAction implements ActionInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function action()
    {
        try {
            $this->user->delete();
            
            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \DELETE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'user' => $this->user ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
        ];
    }
}