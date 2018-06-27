<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Session\flash;
use Illuminate\Support\Facades\Session;

class ProfilesController extends Controller {
	public function index($slug) {

		$friends = Auth::user()->friends();

		$user = User::where('slug', $slug)->first();

		$posts = Post::whereHas('user', function ($query) use ($slug) {
			$query->where('slug', $slug);
		})->get();

		return view('profiles.profile', compact('user', 'posts', 'friends'));
	}

	public function edit() {
		$info = Auth::user()->profile;

		return view('profiles.edit', compact('info'));
	}

	public function update(Request $request) {
		Auth::user()->profile()->update([
			'location' => $request->location,
			'about' => $request->about,
		]);

		if ($request->hasFile('avatar')) {

			Auth::user()->update([
				'avatar' => $request->avatar->store('public/avatars'),
			]);
		}

		Session::flash('success', 'Profile updataed');

		return redirect()->back();
	}

	public function findfriends() {

		$users = Profile::leftJoin('users', 'users.id', 'profiles.user_id')->where('user_id', '!=', Auth::user()->id)->get();

		return view('findfriends', compact('users'));

	}
}
