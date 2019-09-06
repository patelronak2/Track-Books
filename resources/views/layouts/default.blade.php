<!doctype html>
<!-- 
"StAuth10065: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
 -->
<html>
	<head>
		<title>Track-Books</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/materialize.css') }}">
		<!-- CSS USED FROM W3SCHOOL>COM -->
		
	</head>
	<body>
		@include('includes.header')
		@include('includes.navigation')
		@yield('content')
		@include('includes.footer')
	</body>
</html>