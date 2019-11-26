<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;


class ChatsController extends Controller
{
    public function __construct()
	{
	  $this->middleware('auth');
	}
	
	/**
	 * Show chats
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
	  return view('chat.chat');
	}
	
	/**
	 * Fetch all messages
	 *
	 * @return Message
	 */
	public function fetchMessages()
	{
		$messages = Message::with('user')->get();
		return json_encode($messages);
	}
	
	/**
	 * Persist message to database
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function sendMessages(Request $request)
	{
		$messageToAdd = $request->input('message');
		$message = new Message;
		$message->message = $messageToAdd;
		$message->user_id = Auth::id();
		
		if($message->save()){
			echo "OK";
		}
	}
}
