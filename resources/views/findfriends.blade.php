@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-body">
                    @foreach($users as $user)
                        <li class="list-group-item">
                            <img src="<?php echo asset("storage/$user->avatar") ?>" width="40px" height="40px">
                            <a href="{{ route('profile',['slug' => $user->slug]) }}"><label>{{ $user->name }}</label></a> &nbsp; {{ $user->location }}
                            <span class="pull-right"><friend :profile_user_id={{ $user->id }}></friend></span>
                            <br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection