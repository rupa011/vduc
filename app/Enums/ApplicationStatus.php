<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case PENDING = 'Pending';
    case APPROVED = 'Approved';
    case IN_PROGRESS = 'In Progress';
    case COMPLETED = 'Completed';
    case REJECTED = 'Rejected';
}
