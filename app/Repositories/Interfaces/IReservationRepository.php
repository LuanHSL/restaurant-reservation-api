<?php

namespace App\Repositories\Interfaces;

use App\Models\Reservation;

interface IReservationRepository
{
  public function create(array $newReservation): Reservation;
  public function checkAvailability(int $tableNumber, string $date, string $checkInTime, string $checkOutTime): bool;
}
