<?php

namespace App\Traits;

trait HasFullName
{
    public function getFullNameAttribute()
    {
        $first = $this->first_name;
        $middleInitial = $this->middle_name ? strtoupper(substr($this->middle_name, 0, 1)) . '.' : '';
        $last = $this->last_name;
        $extension = $this->extension_name ? ', ' . $this->extension_name : '';

        $fullName = trim("{$first} {$middleInitial} {$last}{$extension}");

        return preg_replace('/\s+/', ' ', $fullName); // Clean up extra spaces
    }
}
