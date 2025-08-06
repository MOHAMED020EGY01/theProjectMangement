<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProjectRequest;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
use App\Notifications\Project\ProjectCreated;
use App\Notifications\Project\ProjectDeleted;
use App\Notifications\Project\ProjectUpdated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    private $companies;
    private $users;

    private $status;

    public function __construct()
    {
        $this->middleware('auth');
        $this->companies = Company::pluck('name', 'id');
        $this->users = User::pluck('name', 'id');
        $this->status = Project::STATUS;
    }


    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $projects = Project::select('id', 'name', 'status', 'description', 'deadline', 'company_id', 'user_id')
            ->with('company:id,name', 'user:id,name')
            ->paginate(7);
        return view(
            'dashboard.project.index',
            [
                'projects' => $projects,
                'companies' => $this->companies,
                'users' => $this->users
            ]
        );
    }


    /**
     * Summary of show
     * @param \App\Models\Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Project $project)
    {
    //     $projects = DB::select("SELECT * FROM projects WHERE status != 'completed'");
    //     $tasks = DB::select("
    //     SELECT tasks.* 
    //     FROM tasks
    //     JOIN projects ON tasks.project_id = projects.id
    //     WHERE projects.status != 'completed'
    //     AND tasks.status != 'completed'
    // ");
    
    //     dd($projects , $tasks);
        
        $chart= DB::select("SELECT status , count(*) as count FROM tasks where project_id = $project->id GROUP BY status");
        $project->load('company:id,name', 'user:id,name');
        return view(
            'dashboard.project.show',
            [
                'project' => $project,
                'companies' => $this->companies,
                'users' => $this->users,
                'now' => \Carbon\Carbon::now(),
                'deadline' => $project->deadline,
                'chart' => $chart,
            ]
        );
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view(
            'dashboard.project.create',
            [
                'companies' => $this->companies,
                'users' => $this->users,
                'status' => $this->status
            ]
        );
    }


    /**
     * Summary of store
     * @param \App\Http\Requests\Dashboard\ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectRequest $request)
    {
        try {
            DB::beginTransaction();

            Project::create($request->validated());
            DB::commit();
            $project = Project::latest()->first();
            $project->user->notify(new ProjectCreated($project));

            return redirect()->route('dashboard.project.index')
            ->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Project creation failed: ' . $e->getMessage());

            return redirect()->route('dashboard.project.index')
                ->with('error', 'Project created failed');
        }
    }

    public function edit(Project $project)
    {
        return view(
            'dashboard.project.edit',
            [
                'project' => $project,
                'companies' => $this->companies,
                'users' => $this->users,
                'status' => $this->status
            ]
        );
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Dashboard\ProjectRequest $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project)
    {
        try {
            DB::beginTransaction();

            $project->update($request->validated());
            DB::commit();
            $project->user->notify(new ProjectUpdated($project));

            return redirect()->route('dashboard.project.index')
                ->with('info', 'Project updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Project update failed: ' . $e->getMessage());

            return redirect()->route('dashboard.project.index')
                ->with('error', 'Project update failed');
        }
    }

    /**
     * Summary of destroy
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        try {
            DB::beginTransaction();
            $project->user->notify(new ProjectDeleted($project));
            $project->delete();
            DB::commit();
            return redirect()->route('dashboard.project.index')
                ->with('warning', 'Project deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Project delete failed: ' . $e->getMessage());

            return redirect()->route('dashboard.project.index')
                ->with('error', 'Project delete failed');
        }
    }
}
