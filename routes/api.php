<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () =>
    response()->json(['success' => true])
);