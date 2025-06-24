<?php

namespace App\Enums;

enum Role: string
{
    case EMPLOYEE = 'Employee';
    case SURVEY_CLIENT = 'Survey Client';
    case STUDENT = 'Student';
    case RENTAL_CLIENT = 'Rental Client';
    case ADMIN = 'Admin';
    case SUPER_ADMIN = 'Super Admin';
}
