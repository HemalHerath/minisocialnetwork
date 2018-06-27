<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class User extends Authenticatable {
	use Notifiable;
	use Friendable;
	use Searchable;

	protected $fillable = [
		'name', 'email', 'password', 'slug', 'gender', 'avatar',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function profile() {
		return $this->hasOne('App\Profile');
	}

	public function posts() {
		return $this->hasMany('App\Post');
	}

	public function getAvatarAttribute($avatar) {

		return asset(Storage::url($avatar));
	}
}
