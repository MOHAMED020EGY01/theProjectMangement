<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index(){
        $companies = Company::paginate(10);
        return view('dashboard.company.index',[
            'companies'=>$companies,
        ]);
    }

    public function show($id){
        $company = Company::with('projects:id,status')->findOrFail($id);
        $chart = DB::select("SELECT status , count(*) as count FROM projects WHERE company_id = $id GROUP BY status");
        return view('dashboard.company.show',[
            'company'=>$company,
            'chart'=>$chart,
        ]);
    }
    public function create(){
        return view('dashboard.company.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'logo'=>'required',
        ]);
        Company::create($request->all());
        return redirect()->route('dashboard.company.index');
    }
    public function edit($id){
        $company = Company::findOrFail($id);
        return view('dashboard.company.edit',[
            'company'=>$company,
        ]);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'logo'=>'required',
        ]);
        $company = Company::findOrFail($id);
        $company->update($request->all());
        return redirect()->route('dashboard.company.index');
    }
    public function destroy($id){
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('dashboard.company.index');
    }
}
