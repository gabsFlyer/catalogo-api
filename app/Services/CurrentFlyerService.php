<?php
namespace App\Services;

use App\Models\Flyer;

class CurrentFlyerService
{
    public function getCurrentFlyer() {
        return Flyer::whereRaw('CURDATE() BETWEEN initial_date AND final_date')
            ->orderByDesc('updated_at')
            ->first();
    }
}
