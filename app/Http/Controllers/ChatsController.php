<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\User;
use Illuminate\Broadcasting\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller {

	public function chat() {

		return view('chat');
	}

	public function send(Request $request) {

		$user = User::find(Auth::id());

		event(new ChatEvent($request->message, $user));

		return $request->all();
	}
}
