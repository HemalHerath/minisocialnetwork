<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast {
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $message;
	public $user;

	public function __construct($message, User $user) {

		$this->message = $message;
		$this->user = $user->name;

		$this->dontBroadcastToCurrentUser();
	}

	public function broadcastOn() {
		return new PrivateChannel('chat');
	}
}
