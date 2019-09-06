<!-- 
"SOA: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
-->
<html>
	<head>
		<title>Track-Books</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/materialize.css') }}">
		<style type="text/css">
			body {
				display: flex;
				min-height: 100vh;
				flex-direction: column;
			  }

			.flex-container {
				flex: 1 0 auto;
			  }
		</style>
	</head>
	<body>
		<div class="flex-container">
			<div class="row">
				<div class="col m6 s12 light-blue lighten-3" style="height: 90vh;">
					<h5 class="center-align">Information Goes Here!</h5>
				</div>
				<div class="col m6 s12 light-blue lighten-5" style="height: 90vh;">
					<h5 class="center-align">Login Form Goes Here!</h5>
				</div>
			</div>
		</div>
		<footer class=" blue-grey lighten-5">
			<div class="footer-copyright">
				<div class="container">
				© 2014 Copyright Text
				<a class="right" href="#!">More Links</a>
				</div>
			</div>
		</footer>
		
	</body>
</html>
