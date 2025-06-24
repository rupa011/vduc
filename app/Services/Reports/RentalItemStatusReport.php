<?php

namespace App\Services\Reports;

use App\Models\RentalItemStatus;

class RentalItemStatusReport
{
    public function getData()
    {
        return RentalItemStatus::all();
    }

    public function getView()
    {
        return 'reports.equipments.partials.rental-item-status';
    }

    public function getTitle()
    {
        return 'Rental Item Status Report';
    }
}
