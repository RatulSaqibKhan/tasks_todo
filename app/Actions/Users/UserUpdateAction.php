<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateAction implements ActionInterface
{
    protected $user, $request;

    public function __construct($request, User $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    public function action()
    {
        try {
            $this->user->fill($this->request->except('_token', '_method'));
            $this->user->save();
            
            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \UPDATE_SUCCESS_MSG;
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