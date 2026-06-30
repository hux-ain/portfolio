<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends BaseController
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        // Mark as read if not already
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function markRead(Message $message)
    {
        $message->update(['is_read' => true]);
        return back()->with('success', 'Message marked as read!');
    }
}
