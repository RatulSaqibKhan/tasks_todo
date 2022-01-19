<?php

namespace App\Actions\Users;

use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
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
            $user = new User();
            $user->name = $this->request->name;
            $user->email = $this->request->email;
            $user->designation = $this->request->designation;
            $user->phone_no = $this->request->phone_no;
            $user->address = $this->request->address;
            $user->password = bcrypt($this->request->password);
            $user->save();
            
            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \SAVE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return [
            'user' => $user ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
        ];
    }
}