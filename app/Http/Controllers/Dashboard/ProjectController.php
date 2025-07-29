<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProjectRequest;
use App\Models\Company;
use App\Models\Project;
use App\Models\User;
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
        $project->load('company:id,name', 'user:id,name');
        return view(
            'dashboard.project.show',
            [
                'project' => $project,
                'companies' => $this->companies,
                'users' => $this->users,
                'now' => \Carbon\Carbon::now(),
                'deadline' => $project->deadline,
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
