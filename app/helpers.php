<?php

use App\Models\Conference;

if (!function_exists('fetchNewestConference')) {
    function fetchNewestConference() {
        return Conference::orderBy('start_date', 'desc')->first();
    }
}
