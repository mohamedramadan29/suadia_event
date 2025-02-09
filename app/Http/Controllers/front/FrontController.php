<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Models\dashboard\Eventtype;
use App\Http\Controllers\Controller;
use App\Models\dashboard\Event;

class FrontController extends Controller
{
    public function index()
    {
        $event_types = Eventtype::all();
        $events = Event::all();
        return view('front.index',compact('event_types','events'));
    }
}
