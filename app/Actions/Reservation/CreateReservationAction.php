<?php

namespace App\Actions\Reservation;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateReservationAction extends Controller
{
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
            $newReservation = $request->toArray();
            $newReservation["user_id"] = $auth->user()->id;

            $reservation = Reservation::create($newReservation);

            return response()->json($reservation);

        } catch (Exception $e) {
            dd($e);
            return response()->json(["messages" => $e->getMessage()], $e->getCode());
        }
    }
}
