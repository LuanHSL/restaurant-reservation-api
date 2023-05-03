<?php

namespace App\UseCase\Reservation;

use App\Repositories\ReservationRepository;

class CheckAvailabilityUseCase
{
    public function __construct(
      private ReservationRepository $repository,
      private CheckOpeningHoursUseCase $checkOpeningHoursUseCase,
    ) {}

    public function __invoke(int $tableNumber, string $date, string $checkInTime, string $checkOutTime): bool
    {
      ($this->checkOpeningHoursUseCase)($checkInTime, $checkOutTime);
      return $this->repository->checkAvailability($tableNumber, $date, $checkInTime, $checkOutTime);
    }
}
