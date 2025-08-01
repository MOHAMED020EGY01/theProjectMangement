<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::where('id', '!=', auth()->id())->get();
        $firstUser = $users->first();
        $messages = $firstUser
        ? Message::where(function ($q) use ($firstUser) {
            $q->where('sender_id', Auth::id())
              ->where('receiver_id', $firstUser->id);
        })->orWhere(function ($q) use ($firstUser) {
            $q->where('sender_id', $firstUser->id)
              ->where('receiver_id', Auth::id());
        })->get()
        : collect();
        return view('dashboard.chat.index', compact('users','messages'));
    }

    public function fetchMessages(\App\Models\User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);

        return response()->json($message);
    }
}
