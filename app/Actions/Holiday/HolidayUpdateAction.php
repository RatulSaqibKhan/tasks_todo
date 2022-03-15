<?php

namespace App\Actions\Holiday;

use App\Http\Requests\HolidayRequest;
use App\Interfaces\ActionInterface;
use App\Models\Holiday;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HolidayUpdateAction implements ActionInterface
{
    /**
     * @var App\Http\Requests\HolidayRequest
     */
    protected HolidayRequest $request;

    /**
     * @var App\Models\Holiday
     */
    protected Holiday $holiday;

    /**
     * Constructor
     * 
     * @param App\Http\Requests\HolidayRequest
     */
    public function __construct(HolidayRequest $request, Holiday $holiday)
    {
        $this->request = $request;
        $this->holiday = $holiday;
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
            $this->holiday->fill($this->request->except('_token'));
            $this->holiday->save();
            DB::commit();

            $primaryMessage = \SUCCESS_MSG;
            $secondaryMessage = \UPDATE_SUCCESS_MSG;
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
            'holiday' => $this->holiday ?? null,
            'status' => $status ?? null,
            'toastContainer' => view('includes.toastr_content', \compact('iconClass', 'primaryMessage', 'secondaryMessage'))->render(),
        ];
    }

    /**
     * @param $file_name_to_delete
     * @return bool
     */
    public function hasPrevImage($file_name_to_delete): bool
    {
        return Storage::disk('public')->exists('/holiday_logo/' . $file_name_to_delete) && $file_name_to_delete != null;
    }
}