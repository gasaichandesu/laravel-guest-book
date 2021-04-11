<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Repositories\MessagesRepository;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $messagesRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messages = $this->messagesRepository->paginated();

        return view('home', compact('messages'));
    }

    public function update(Message $message)
    {
        if ($message->user_id != Auth::id()) {
            abort(401, 'You are not allowed to be here');
        }

        $messages = $this->messagesRepository->paginated();

        return view('home', compact('messages', 'message'));
    }

    public function reply(Message $message)
    {
        $messages = $this->messagesRepository->paginated();

        $inReplyTo = $message->id;

        return view('home', compact('messages', 'inReplyTo'));
    }
}
