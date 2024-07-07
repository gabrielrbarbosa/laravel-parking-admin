<?php

namespace App\Enums;

enum FuelType: string
{
    case GASOLINE = 'gasoline';
    case ETHANOL = 'ethanol';
    case FLEX = 'flex';
    case DIESEL = 'diesel';
    case ELECTRIC = 'electric';
    case HYBRID = 'hybrid';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
