<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\dashboard\Admin;
use App\Models\dashboard\Invoice;
use App\Http\Controllers\Controller;
use App\Models\dashboard\ProblemCategory;
use App\Models\dashboard\Role;

class WelcomeController extends Controller
{
    public function index(){
        $invoices = Invoice::orderBy('id','desc')->limit(10)->get();
        $invoices_count = $invoices->count();
        $AdminCount = Admin::count();
        $roles = Role::count();
        $problems = ProblemCategory::count();
        return view("dashboard.welcome",compact('invoices','invoices_count','AdminCount','roles','problems'));
      }
}
