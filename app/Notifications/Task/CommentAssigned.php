<?php

namespace App\Notifications\Task;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentAssigned extends Notification
{
    use Queueable;

    public $comment;
    /**
     * Create a new notification instance.
     */
    public function __construct($comment)
    {
        $this->comment = $comment;

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
            'title' => 'Comment Alert',
            'body' => [
                'name' => $this->comment->user->name,
                'deadline' => $this->comment->task->project->deadline->format('Y-m-d'),
                'message' => $this->comment->content,
            ],
            'id'=>$this->comment->id,
            'url' => route('dashboard.project.tasks.show', [$this->comment->task->project->id,$this->comment->task->id]),
        ];
    }
    public function toBroadcast()
    {
        return new BroadcastMessage([
            'title' => 'Comment Alert',
            'body' => [
                'name' => $this->comment->user->name,
                'deadline' => $this->comment->task->project->deadline->format('Y-m-d'),
                'message' =>  $this->comment->content,
                
            ],
            'Alert_id'=>$this->comment->id,
            'url' => route('dashboard.project.tasks.show', [$this->comment->task->project->id,$this->comment->task->id]),
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
            'title' => 'Comment Alert',
            'body' => [
                'name' => $this->comment->user->name,
                'deadline' => $this->comment->task->project->deadline->format('Y-m-d'),
                'message' => "Fast to Solve this Project",
            ],
            'id'=>$this->comment->id,
            'url' => route('dashboard.project.tasks.show', [$this->comment->task->project->id,$this->comment->task->id]),
        ];
    }
}
