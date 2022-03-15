<?php

namespace App\Actions\Holiday;

use App\Http\Requests\HolidayRequest;
use App\Interfaces\ActionInterface;
use App\Models\Holiday;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HolidayStoreAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\HolidayRequest
     */
    protected HolidayRequest $request;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\HolidayRequest
     */
    public function __construct(HolidayRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Store new Holiday, set role and assign to multiple factories
     * 
     * @return array
     */
    public function action(): array
    {
        try {
            DB::beginTransaction();
            $holiday = new Holiday();
            $holiday->fill($this->request->except('_token'));
            $holiday->save();
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
            'holiday' => $holiday ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }
}