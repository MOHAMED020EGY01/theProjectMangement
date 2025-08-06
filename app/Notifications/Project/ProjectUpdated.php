<?php

namespace App\Notifications\Project;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $project;
    /**
     * Create a new notification instance.
     */
    public function __construct($project)
    {
        $this->project = $project;
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
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Project Updated',
            'body' => [
                'name' => $this->project->user->name,
                'deadline' => $this->project->deadline->format('Y-m-d'),
                'message' => $this->project->description,
            ],
            'id'=>$this->project->id,
            'url' => route('dashboard.project.show', $this->project->id),
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Project Updated',
            'body' => [
                'name' => $this->project->user->name,
                'deadline' => $this->project->deadline->format('Y-m-d'),
                'message' =>  $this->project->description,
                
            ],
            'id'=>$this->project->id,
            'url' => route('dashboard.project.show', $this->project->id),
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
            'title' => 'Project Updated',
            'body' => [
                'name' => $this->project->user->name,
                'deadline' => $this->project->deadline->format('Y-m-d'),
                'message' => $this->project->description,
            ],
            'id'=>$this->project->id,
            'url' => route('dashboard.project.show', $this->project->id),
        ];
    }
}
