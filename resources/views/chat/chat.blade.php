@extends('layouts.default')

@section('content')
	<chat-messages :messages="messages"></chat-messages>
	<chat-form
		v-on:messagesent="addMessage"
		:user="{{ Auth::user() }}"
	></chat-form>
@endsection('content')