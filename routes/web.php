<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/map', function() {
    return view('map-test');
});

Route::get('/capture-location', function() {
    return view('gps-capture');
});

// Simple dashboard sa pagkakaron - dili sa folder
Route::get('/dashboard', function() {
    return "<h1>Tree Monitoring Dashboard</h1><p>Working ang route!</p>";
});


