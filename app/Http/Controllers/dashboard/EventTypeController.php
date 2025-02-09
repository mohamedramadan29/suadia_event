<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Eventtype;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function index()
    {
        $types = Eventtype::paginate(12);
        return view("dashboard.event_types.index",compact('types'));
    }
}
