<?php
namespace App\Services;

use App\Models\Flyer;

class CurrentFlyerService
{
    public function getCurrentFlyer() {
        return Flyer::whereRaw('CURDATE() >= initial_date')
            ->orderByDesc('updated_at')
            ->first();
    }
}
