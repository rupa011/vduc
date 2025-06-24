<?php

namespace App\Services\Reports;

use App\Models\Rental;

class RentalReport
{
    public function getData()
    {
        return Rental::all();
    }

    public function getView()
    {
        return 'reports.equipments.partials.equipment';
    }

    public function getTitle()
    {
        return 'Rental Report';
    }
}
