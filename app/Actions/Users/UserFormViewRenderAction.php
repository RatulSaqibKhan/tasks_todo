<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserFormViewRenderAction implements ActionInterface
{
    protected $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function action()
    {
        try {
            $form = view('users.form', [
                'user' => $this->user ?? null
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