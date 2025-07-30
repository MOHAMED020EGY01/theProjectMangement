<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    private $users = null;
    private $projects = null;
    private $status = null;
    public function __construct(){
        $this->middleware('auth');
        $this->users = \App\Models\User::pluck('name', 'id');
        $this->status = Task::STATUS;
        if(\Illuminate\Support\Facades\Auth::check()){
            $this->projects = \App\Models\Project::
            where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->with('company')
            ->pluck('name', 'id');
        }
    }
    /**
     * Summary of index
     * @param mixed $project_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($project_id){
        $tasks = Task::where('project_id', $project_id)
        ->with('user:id,name','project:id,name')
        ->paginate(7);
        return view('dashboard.task.index', 
        [
            'project_id'=>$project_id,
            'tasks'=>$tasks,
            'projects'=>$this->projects,
            'status'=>$this->status
        ]);
    }

    /**
     * Summary of create
     * @param mixed $project_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create($project_id){
        if(!\App\Models\Project::where('id', $project_id)->exists()){
            return redirect()->route('dashboard.project.index')
            ->with('error', 'Project not found');
        }
        return view('dashboard.task.create', [
            'project_id'=>$project_id,
            'projects'=>$this->projects,
            'users'=>$this->users,
            'status'=>$this->status
        ]);
    }
    /**
     * Summary of store
     * @param \App\Http\Requests\Dashboard\TaskRequest $request
     * @param mixed $project_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request,$project_id){

        try {
            DB::beginTransaction();
            Task::create($request->validated());
            DB::commit();
            return redirect()
            ->route('dashboard.project.tasks.index', $project_id)
            ->with('success','Task created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Task creation failed: ' . $e->getMessage());
            return redirect()->route('dashboard.project.tasks.index', $request->project_id)
                ->with('error', 'Task creation failed');
        }
    }

    /**
     * Summary of edit
     * @param mixed $project_id
     * @param mixed $task_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($project_id,$task_id){
        $task = self::findTaskByIdAndProject($project_id,$task_id);
        return view('dashboard.task.edit', [
            'task'=>$task,
            'projects'=>$this->projects,
            'users'=>$this->users,
            'status'=>$this->status
        ]);
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Dashboard\TaskRequest $request
     * @param mixed $project_id
     * @param mixed $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskRequest $request, $project_id,$task_id){
        $task = self::findTaskByIdAndProject($project_id,$task_id);
        try {
            DB::beginTransaction();
            $task->update($request->validated());
            DB::commit();
            return redirect()
            ->route('dashboard.project.tasks.index', $task->project_id)
            ->with('info','Task updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Task update failed: ' . $e->getMessage());
            return redirect()->route('dashboard.project.tasks.index', $task->project_id)
                ->with('error', 'Task update failed');
        }
    }
    /**
     * Summary of destroy
     * @param mixed $project_id
     * @param mixed $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($project_id,$task_id){

        $task = self::findTaskByIdAndProject($project_id,$task_id);
        try {
            DB::beginTransaction();
            $task->delete();
            DB::commit();
            return redirect()
            ->route('dashboard.project.tasks.index', $task->project_id)
            ->with('warning','Task deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Task delete failed: ' . $e->getMessage());
            return redirect()->route('dashboard.project.tasks.index', $task->project_id)
                ->with('error', 'Task delete failed');
        }
    }

    /**
     * Summary of show
     * @param mixed $project_id
     * @param mixed $task_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($project_id,$task_id){
        $task = self::findTaskByIdAndProject($project_id,$task_id);
        return view('dashboard.task.show', [
            'task'=>$task,
        ]);
    }


    public static function findTaskByIdAndProject($project_id,$task_id)
    {
        return Task::where('id', $task_id)
            ->with('user:id,name','project:id,name,company_id')
            ->where('project_id', $project_id)
            ->firstOrFail();
    }
}
