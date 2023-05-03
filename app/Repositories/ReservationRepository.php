<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Repositories\Interfaces\IReservationRepository;

class ReservationRepository implements IReservationRepository
{
  public function create(array $newReservation): Reservation
  {
    return Reservation::create($newReservation);
  }

  public function checkAvailability(int $tableNumber, string $date, string $checkInTime, string $checkOutTime): bool
  {
    $reservation = Reservation::where('table_number', $tableNumber)
      ->where('date', $date)
      ->where(function ($query) use ($checkInTime, $checkOutTime) {
        $query->whereBetween('checkin_time', [$checkInTime, $checkOutTime])
              ->orWhereBetween('checkout_time', [$checkInTime, $checkOutTime]);
      })
      ->exists();
    
    return !$reservation;
  }
}
