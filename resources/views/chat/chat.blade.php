@extends('layouts.default')

@section('content')
	<h2>Show some content here!</h2>
	<ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        Ronak Patel
                    </strong>
                </div>
                <p>
                    Hey There!
                </p>
            </div>
        </li>
    </ul>
	
	<div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." >

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat">
                Send
            </button>
        </span>
    </div>

@endsection('content')