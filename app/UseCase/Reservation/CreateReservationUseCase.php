<?php

namespace App\UseCase\Reservation;

use App\Models\Reservation;
use App\Repositories\ReservationRepository;

class CreateReservationUseCase
{
    public function __construct(
      private ReservationRepository $repository,
      private CheckAvailabilityUseCase $checkAvailabilityUseCase,
    ) {}

    public function __invoke(Reservation $reservation)
    {
      $exist = ($this->checkAvailabilityUseCase)(
        $reservation->table_number,
        $reservation->date,
        $reservation->checkin_time,
        $reservation->checkout_time,
      );
      if (!$exist) {
        throw new \InvalidArgumentException('Mesa não disponível para o horário selecionado. Por favor, selecione outro horário ou outra mesa.', 400);
      }

      return $this->repository->create($reservation->toArray());
    }
}
