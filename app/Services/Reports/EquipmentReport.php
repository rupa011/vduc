<?php

namespace App\Services\Reports;

use App\Models\Equipment;

class EquipmentReport
{
    public function getData()
    {
        return Equipment::all();
    }

    public function getView()
    {
        return 'reports.equipments.partials.equipment';
    }

    public function getTitle()
    {
        return 'Equipment Report';
    }
}
