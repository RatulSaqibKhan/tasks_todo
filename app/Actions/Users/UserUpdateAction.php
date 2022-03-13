<?php

namespace App\Actions\Users;

use App\Http\Requests\UserRequest;
use App\Interfaces\ActionInterface;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateAction implements ActionInterface
{
    /**
     * @var object
     */
    protected object $user;
    
    /**
     * @var App\Http\Requests\UserRequest
     */
    protected UserRequest $request;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\UserRequest
     * @param App\Models\User
     */
    public function __construct(UserRequest $request, User $user)
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
            $this->user->fill($this->request->except('_token', '_method'));
            $this->user->save();
            
            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \UPDATE_SUCCESS_MSG;
            $status = Response::HTTP_OK;
            $iconClass = 'bx bxs-message-square-check';
        } catch (Exception $e) {
            $primaryMessage = \ERROR_MSG;
            $secondaryMessage = $e->getMessage();
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $iconClass = 'bx bxs-message-square-error';
        }

        return [
            'user' => $this->user ?? null,
            'status' => $status ?? null,
            'primaryMessage' => $primaryMessage ?? null,
            'secondaryMessage' => $secondaryMessage ?? null,
            'iconClass' => $iconClass ?? null,
        ];
    }
}