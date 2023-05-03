<?php

namespace App\UseCase\Reservation;

use App\Constants\TimeConst;

class CheckOpeningHoursUseCase
{

    public function __invoke(string $checkInTime, string $checkOutTime): void
    {
      if ($checkOutTime <= $checkInTime) {
        throw new \InvalidArgumentException('Horário de check-out inválido. O horário de check-out (' . $checkOutTime . ') deve ser maior do que o horário de check-in (' . $checkInTime . ').', 400);
      }

      if (!($checkInTime >= TimeConst::MINIMUM_TIME && $checkInTime <= TimeConst::MAXIMUN_TIME)) {
        throw new \InvalidArgumentException('Horário de check-in inválido. O horário deve estar entre ' . TimeConst::MINIMUM_TIME . ' e ' . TimeConst::MAXIMUN_TIME . '.', 400);
      }

      if (!($checkOutTime >= TimeConst::MINIMUM_TIME && $checkOutTime <= TimeConst::MAXIMUN_TIME)) {
        throw new \InvalidArgumentException('Horário de check-out inválido. O horário deve estar entre ' . TimeConst::MINIMUM_TIME . ' e ' . TimeConst::MAXIMUN_TIME . '.', 400);
      }
    }
}
