@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $profile->user->name }} Profile</div>

                <div class="card-body">
                    View Another user profile
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
