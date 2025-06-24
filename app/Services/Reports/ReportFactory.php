<?php

namespace App\Services\Reports;

class ReportFactory
{
    public static function make($type)
    {
        return match ($type) {
            'equipment' => new EquipmentReport(),
            'rental' => new RentalReport(),
            'equipment_rental_items' => new EquipmentRentalItemsReport(),
            'rental_item_status' => new RentalItemStatusReport(),
            default => null
        };
    }

    public static function options()
    {
        return [
            'equipment' => 'Equipment Report',
            // 'rental' => 'Rental Report',
            'equipment_rental_items' => 'Equipment Rental Items Report',
            // 'rental_item_status' => 'Rental Item Status Report',
        ];
    }
}
