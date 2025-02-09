<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Collage;
use Illuminate\Http\Request;

class CollageController extends Controller
{
    public function index()
    {
        $collages = Collage::paginate(12);
        return view("dashboard.collages.index",compact('collages'));
    }
}
