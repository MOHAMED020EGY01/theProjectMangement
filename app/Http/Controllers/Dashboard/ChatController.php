<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\Chat\BoadcastChat;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('dashboard.chat.index', compact('users'));
    }
    public function show(User $user){
            $messages = Message::where('sender_id', Auth::id())
            ->where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->orderBy('created_at')
            ->get();
            return response()->json([
                'data' =>$messages,
                'user' => $user->name,
            ]);
    }

    public function sendMessage(Request $request, User $user)
    {
        
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = new Message([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);
        $message->save();
        
        event(new BoadcastChat($message));

        return response()->json($message);
    }
}
