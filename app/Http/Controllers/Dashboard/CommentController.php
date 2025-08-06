<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use App\Notifications\Task\CommentAssigned;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    
        $recentComment = $task->comments()
            ->where('user_id', auth()->id())
            ->where('created_at', '>=', now()->subSeconds(3))
            ->first();
    
        if ($recentComment) {
            return response()->json([
                'error' => 'You are commenting too fast! Please wait a moment.',
            ], 429);
        }
    
        $comment = $task->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        $comment_id = $comment->id;
        $task->user->notify(new CommentAssigned($comment));
    
        return response()->json([
            'content' => $comment->content,
            'user_name' => $comment->user->name,
            'comment_id' => $comment_id,
        ]);
    }
}
