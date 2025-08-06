<?php

namespace App\Notifications\Task;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCreated extends Notification
{
    use Queueable;

    public $task;
    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }


    /**
     * Summary of toDatabase
     * @param mixed $notifiable
     * @return array{assigned_by: mixed, task_id: mixed, task_name: mixed, title: string}
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Task Created',
            'body' => [
                'name' => $this->task->user->name,
                'deadline' => $this->task->project->deadline->format('Y-m-d'),
                'message' => $this->task->title,
            ],
            'id'=>$this->task->id,
            'url' => route('dashboard.project.tasks.show', [$this->task->project->id,$this->task->id]),
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Task Created',
            'body' => [
                'name' => $this->task->user->name,
                'deadline' => $this->task->project->deadline->format('Y-m-d'),
                'message' => $this->task->title,
            ],
            'Alert_id'=>$this->task->id,
            'url' => route('dashboard.project.tasks.show', [$this->task->project->id,$this->task->id]),
        ]);
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Task Created',
            'body' => [
                'name' => $this->task->user->name,
                'deadline' => $this->task->project->deadline->format('Y-m-d'),
                'message' => $this->task->title,
            ],
            'url' => route('dashboard.project.tasks.show', [$this->task->project->id,$this->task->id]),
        ];
    }
}
