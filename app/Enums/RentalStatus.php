<?php

namespace App\Enums;

enum RentalStatus: string
{
    case PENDING = 'Pending';
    case CONFIRMED = 'Confirmed';
    case RELEASED = 'Released';
    case RETURNED = 'Returned';
    case CANCELLED = 'Cancelled';
}
