<?php

namespace App\Services\Reports;

use App\Models\Rental;

class EquipmentRentalItemsReport
{
    public function getData()
    {
        return Rental::with('equipment')->get();
    }

    public function getView()
    {
        return 'reports.equipments.partials.equipment-rental-items';
    }

    public function getTitle()
    {
        return 'Equipment Rental Items Report';
    }
}
