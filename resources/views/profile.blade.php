@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <img src="{{ $avatarUrl }}" alt="profile picture" width="100px" height="100px">
                        <h1>{{ $user->username }}'s profile</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
