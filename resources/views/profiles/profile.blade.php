@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<p class="text-center">
						{{$user->name}}'s profile
					</p>
				</div>
				<div class="panel-body">
					<center>
						<img src="{{ $user->avatar }}" width="140px" height="140px" style="border-radius: 50%">
					</center>
					<br>
					<p class="text-center">
						{{ $user->profile->location }}
					</p>
					<br>
					<p class="text-center">
						@if(Auth::id() == $user->id)
							<a href="{{ route('profile.edit') }}" class="btn btn-info">Edit your profile</a>
						@endif
					</p>
				</div>
			</div>

			@if(Auth::id() !== $user->id)
				<div class="panel panel-default">
					<div class="panel-body">
						<friend :profile_user_id={{ $user->id }}></friend>
					</div>
				</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">
					<p class="text-center">
						About me .
					</p>
				</div>
				<div class="panel-body">
					<p class="text-center">
						{{ $user->profile->about }}
					</p>
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<p class="text-center">
						Posts
					</p>
				</div>
			</div>
			@foreach($posts as $post)
				<div class="panel-body">
					<li class="text-center list-group-item">
						{{ $post->content }}
					</li>
				</div>
			@endforeach
		</div>

		@if(Auth::id() == $user->id)
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="text-center">
							Friends
						</p>
					</div>
				</div>
				@foreach($friends as $friend)
					<div class="panel-body">
						<li class="list-group-item">
                            <img src="{{ $friend->avatar }}" width="30px" height="30px">
                            <a href="{{ route('profile',['slug' => $friend->slug]) }}"><label>{{ $friend->name }}</label></a> &nbsp; {{ $friend->location }}
                        </li>
					</div>
				@endforeach
			</div>
		@endauth
	</div>
@endsection