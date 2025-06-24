<?php

namespace App\Enums;

enum ItemCondition: string
{
    case OKAY = 'Okay';
    case DAMAGE = 'Damage';
    case LOST = 'Lost';
}
