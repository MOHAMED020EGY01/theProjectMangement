<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Notifications\Project\ProjectAlert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StatusProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:status-project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->notificationProjectAlert();
        //$this->changeStatusProject();
    }
    public function notificationProjectAlert(){
        $projects = Project::where('status','!=','completed')
        ->where('deadline','<=',now()->addDays(2))
        ->get();
        foreach ($projects as $project) {
            $project->user->notify(new ProjectAlert($project));
        }
    }

    public function changeStatusProject(){
        $projects = DB::select("SELECT * FROM projects WHERE status != 'completed' AND deadline <= NOW()");
        $tasks = DB::select("SELECT * FROM projects WHERE status != 'completed' AND (SELECT * FROM tasks WHERE project_id = projects.id AND status != 'completed')");
        if(count($tasks) == 0){
            foreach ($projects as $project) {
                $project->update([
                    'status' => 'completed',
                ]);
            }
        }
    }
}
