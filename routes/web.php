<?php

use Illuminate\Support\Facades\Route;

// Only API routes - React handles all frontend routes
Route::get('/', function () {
    return redirect('http://localhost:5173'); // Your Vite dev server
});

// API routes will be handled by routes/api.php