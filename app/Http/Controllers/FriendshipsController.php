<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class FriendshipsController extends Controller implements ShouldQueue {

	public function check($id) {

		if (Auth::user()->is_friends_with($id) == 1) {

			return ["status" => "friends"];
		}

		if (Auth::user()->has_pending_friend_request_from($id)) {

			return ["status" => "pending"];
		}

		if (Auth::user()->has_pending_friend_request_sent_to($id)) {

			return ["status" => "waiting"];
		}

		return ["status" => 0];
	}

	public function add_friend($id) {

		$response = Auth::user()->add_friend($id);

		User::find($id)->notify(new \App\Notifications\NewFriendRequest(Auth::user()));

		return $response;
	}

	public function accept_friend($id) {

		$response = Auth::user()->accept_friend($id);

		User::find($id)->notify(new \App\Notifications\FriendRequestAccepted(Auth::user()));

		return $response;
	}
}
