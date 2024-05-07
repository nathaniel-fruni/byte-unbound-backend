<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function getSpeakers() {
        $speakers  = Speaker::with('partner')->get();
        return response()->json($speakers);
    }
}
