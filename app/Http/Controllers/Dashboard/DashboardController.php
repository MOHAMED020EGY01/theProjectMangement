<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $chart = DB::select("SELECT status , count(*) as count FROM projects GROUP BY status");
        return view('dashboard.dashboard',[
            'chart'=>$chart,
        ]);
    }
}
