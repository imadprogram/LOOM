<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;

class MessageController extends Controller
{
    public function index(Request $request) {
        $userId = auth()->id();

        // pluck returns only one a specific column bla kolchi
        $contactIds = Message::where('sender_id', $userId)->pluck('receiver_id')
                    ->merge(Message::where('receiver_id', $userId)->pluck('sender_id'))
                    ->unique();
        //unique is if we messaged the same person 50 times , katbino gha mra whda bla mat3awd l id

        $contacts = User::whereIn('id', $contactIds)->get();

        $activeContact = null;
        $messages = collect();
        $annonceId = $request->annonce_id;

        if ($request->has('user_id')) {
            $activeContact = User::findOrFail($request->user_id);
            
            $messages = Message::where(function ($query) use ($userId, $activeContact) {
                $query->where('sender_id', $userId)->where('receiver_id', $activeContact->id);
            })->orWhere(function ($query) use ($userId, $activeContact) {
                $query->where('sender_id', $activeContact->id)->where('receiver_id', $userId);
            })->oldest()->get();
        }

        return view('messages', compact('contacts', 'activeContact', 'messages', 'annonceId'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'content' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
            'annonce_id' => 'required|exists:annonces,id'
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $validated['receiver_id'],
            'annonce_id' => $validated['annonce_id'],
            'content' => $validated['content']
        ]);

        MessageSent::dispatch($message);

        return response()->json($message);
    }
}
