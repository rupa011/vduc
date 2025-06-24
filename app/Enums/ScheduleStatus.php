<?php

namespace App\Enums;

enum ScheduleStatus: string
{
    case PENDING = 'Pending';
    case APPROVED = 'Approved';
    case DECLINED = 'Decline';
    case COMPLETED = 'Completed';
}
