<?php

use Illuminate\Support\Facades\Route;




Route::get('/putamerda', function() {
    return response()->json(['message' => 'puta merda'], 200);
});
