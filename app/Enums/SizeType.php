<?php

namespace App\Enums;

enum SizeType: string
{
    case HATCHBACK = 'hatchback';
    case SEDAN = 'sedan';
    case SUV = 'suv';
    case PICKUP = 'pickup';
    case VAN = 'van';
    case MOTORCYCLE = 'motorcycle';
    case TRUCK = 'truck';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
