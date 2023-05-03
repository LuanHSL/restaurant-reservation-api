<?php

namespace App\Actions\Reservation;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\UseCase\Reservation\CreateReservationUseCase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CreateReservationAction extends Controller
{
    public function __construct(
        private CreateReservationUseCase $createReservationUseCase,
    ){}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'checkin_time' => 'required|date_format:H:i',
                'checkout_time' => 'required|date_format:H:i',
                'table_number' => 'required',
            ]);

            $auth = auth()->guard('web');
            $reservation = $request->toArray();
            $reservation["user_id"] = $auth->user()->id;

            return response()->json(($this->createReservationUseCase)(new Reservation($reservation)));
        } catch (Exception $e) {
            return response()->json(["messages" => $e->getMessage()], $e->getCode());
        }
    }
}
