<?php

namespace App\Enums;

enum TransmissionType: string
{
    case MANUAL = 'manual';
    case AUTOMATIC = 'automatic';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
