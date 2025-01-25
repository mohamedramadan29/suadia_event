<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\dashboard\Role;
use App\Models\dashboard\Admin;
use App\Models\dashboard\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\dashboard\ProblemCategory;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->user()->type == 'فني') {
            $availableInvoices = Invoice::where('admin_repair_id', null)->orderBy('id', 'desc')->paginate(10);
        } else {
            $availableInvoices = Invoice::orderBy('id', 'desc')->limit(10)->get();
        }
        $invoices_count = $availableInvoices->count();
        $AdminCount = Admin::count();
        $roles = Role::count();
        $problems = ProblemCategory::count();
        return view("dashboard.welcome", compact( 'invoices_count', 'AdminCount', 'roles', 'problems','availableInvoices' ));
    }
}
