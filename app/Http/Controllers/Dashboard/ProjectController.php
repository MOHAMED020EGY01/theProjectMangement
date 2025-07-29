<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProjectRequest;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    private $companies;
    private $users;

    public function __construct()
    {
        $this->middleware('auth');
        $this->companies = Company::pluck('name','id');
        $this->users = User::pluck('name','id');
    }

    public function index(){
        $projects = Project::select('id','name','description','deadline','company_id','user_id')
        ->with('company:id,name','user:id,name')
        ->paginate(7);
        return view('dashboard.project.index',
        [
            'projects'=>$projects,
            'companies'=>$this->companies,
            'users'=>$this->users
        ]);
    }

    public function show(Project $project){
        $project->load('company:id,name','user:id,name');
        return view('dashboard.project.show',
        [
            'project'=>$project,
            'companies'=>$this->companies,
            'users'=>$this->users
        ]);
    }

    public function create(){
        return view('dashboard.project.create',
        [
            'companies'=>$this->companies,
            'users'=>$this->users
        ]);
    }

    public function store(ProjectRequest $request){
        
        Project::create($request->validated());
        return redirect()->route('dashboard.project.index')
        ->with('success','Project created successfully');
    }

    public function edit(Project $project){
        return view('dashboard.project.edit',
        [
            'project'=>$project,
            'companies'=>$this->companies,
            'users'=>$this->users
        ]);
    }

    public function update(ProjectRequest $request,Project $project){
        
        $project->update($request->validated());
        return redirect()->route('dashboard.project.index')
        ->with('success','Project updated successfully');
    }

    public function destroy(Project $project){
        $project->delete();
        return redirect()->route('dashboard.project.index')
        ->with('warning','Project deleted successfully');
    }
}
