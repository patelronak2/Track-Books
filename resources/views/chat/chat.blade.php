@extends('layouts.default')

@section('content')
	<h2>Show some content here!</h2>
	<chat-messages :messages="messages"></chat-messages>
	<chat-form
		v-on:messagesent="addMessage"
		:user="{{ Auth::user() }}"
	></chat-form>
@endsection('content')