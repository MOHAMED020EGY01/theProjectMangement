<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $projects = Project::where('status','!=','completed')->where('deadline','>=',now()->subDays(2))->paginate(7);
        $chart = DB::select("SELECT status , count(*) as count FROM projects GROUP BY status");
        return view('dashboard.dashboard',[
            'chart'=>$chart,
            'projects'=>$projects,
        ]);
    }
}
