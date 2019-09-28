@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}'s Profile</div>

                <div class="card-body">
                    Welcome to your Profile Page!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
