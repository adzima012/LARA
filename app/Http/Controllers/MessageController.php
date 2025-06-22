<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the user's messages.
     */
    public function index()
    {
        $messages = Message::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard', compact('messages'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipient_name'     => 'required|string|max:255',
            'recipient_email'    => 'required|email',
            'delivery_schedule'  => 'required|string',
            'message'            => 'required|string',
        ]);

        Message::create([
            'recipient_name'     => $request->recipient_name,
            'recipient_email'    => $request->recipient_email,
            'delivery_schedule'  => $request->delivery_schedule,
            'message'            => $request->message,
            'repeat_yearly'      => $request->has('repeat_yearly'),
            'user_id'            => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Message created successfully.');
    }

    /**
     * Show the form for editing the specified message.
     */
    public function edit(Message $message)
    {
        $this->authorizeOwner($message);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified message in storage.
     */
    public function update(Request $request, Message $message)
    {
        $this->authorizeOwner($message);

        $request->validate([
            'recipient_name'     => 'required|string|max:255',
            'recipient_email'    => 'required|email',
            'delivery_schedule'  => 'required|string',
            'message'            => 'required|string',
        ]);

        $message->update([
            'recipient_name'     => $request->recipient_name,
            'recipient_email'    => $request->recipient_email,
            'delivery_schedule'  => $request->delivery_schedule,
            'message'            => $request->message,
            'repeat_yearly'      => $request->has('repeat_yearly'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message)
    {
        $this->authorizeOwner($message);

        $message->delete();

        return redirect()->route('dashboard')->with('success', 'Message deleted successfully.');
    }

    /**
     * Ensure the authenticated user is the owner of the message.
     */
    private function authorizeOwner(Message $message)
    {
        if ($message->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
