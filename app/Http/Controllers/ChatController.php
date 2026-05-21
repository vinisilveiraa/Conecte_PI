<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function listConversations()
    {
        $conversations = Conversation::where(function ($query) {

            $query->where('client_user_id', Auth::id())
                ->orWhere('caregiver_user_id', Auth::id());
        })
            ->orderBy('last_message_at', 'desc')
            ->get();

        $conversations->transform(function ($conversation) {

            $conversation->client =
                User::find($conversation->client_user_id);

            $conversation->caregiver =
                User::find($conversation->caregiver_user_id);

            return $conversation;
        });

        return response()->json($conversations);
    }

    public function getMessages($conversation_id)
    {
        $messages = Message::where('conversation_id', $conversation_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function markAsRead($conversation_id)
    {
        Message::where('conversation_id', $conversation_id)
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now()
            ]);
    }

    public function createChat(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required'
        ]);

        $proposal = Proposal::findOrFail($request->proposal_id);

        // cria so se nao tiver conversa com esses usuarios
        $conversation = Conversation::firstOrCreate([
            'client_user_id' => $proposal->client->user->id,
            'caregiver_user_id' => $proposal->caregiver->user->id,
        ], [
            'proposal_id' => $proposal->id,
            'last_message' => '',
            'last_message_at' => now()
        ]);

        return redirect()->route('client.chat');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required',
            'message' => 'required|string|max:1000'
        ]);

        $conversation = Conversation::findOrFail($request->conversation_id);

        if (
            Auth::id() != $conversation->client_user_id &&
            Auth::id() != $conversation->caregiver_user_id
        ) {
            abort(403);
        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'read_at' => null
        ]);

        $conversation->update([
            'last_message' => $message->message,
            'last_message_at' => now()
        ]);

        return response()->json([
            'message' => $message
        ]);
    }
}
