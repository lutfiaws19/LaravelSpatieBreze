<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;

class ChatController extends Controller
{
    /**
     * Display the chat messages between the authenticated user and a specific receiver.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
public function index(Request $request)
{
    $receiver_id = $request->query('receiver_id');
    $users = User::where('id', '!=', auth()->id())->get();
    $messages = [];

    if ($receiver_id) {
        $messages = Message::with(['user', 'receiver'])
            ->where(function ($q) use ($receiver_id) {
                $q->where('user_id', auth()->id())
                  ->where('receiver_id', $receiver_id);
            })
            ->orWhere(function ($q) use ($receiver_id) {
                $q->where('user_id', $receiver_id)
                  ->where('receiver_id', auth()->id());
            })
            ->orderBy('created_at')
            ->get();
    }

    return view('chat', compact('messages', 'receiver_id', 'users'));
}

public function send(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:255',
        'receiver_id' => 'required|exists:users,id',
    ]);

    $message = new Message();
    $message->user_id = auth()->id();
    $message->receiver_id = $request->receiver_id;
    $message->content = $request->content;
    $message->save();

    broadcast(new MessageSent($message))->toOthers();

      return redirect()->route('chat.index', ['receiver_id' => $request->receiver_id])
        ->with('success', 'Pesan berhasil dikirim!');
}
public function destroy(Message $message)
{
    // Hanya pengirim yang bisa menghapus pesannya sendiri
    if ($message->user_id == auth()->id()) {
        $message->delete();
        return back()->with('success', 'Pesan berhasil dihapus!');
    }
    return back()->with('error', 'Anda tidak bisa menghapus pesan ini!');
}

public function reset($receiver_id)
{
    // Hapus semua pesan antara user login dan receiver
    Message::where(function ($q) use ($receiver_id) {
        $q->where('user_id', auth()->id())
          ->where('receiver_id', $receiver_id);
    })
    ->orWhere(function ($q) use ($receiver_id) {
        $q->where('user_id', $receiver_id)
          ->where('receiver_id', auth()->id());
    })
    ->delete();

    return redirect()->route('chat.index', ['receiver_id' => $receiver_id])
        ->with('success', 'Percakapan berhasil direset!');
}
}
