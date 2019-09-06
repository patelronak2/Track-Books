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
		
		<!-- CSS USED FROM W3SCHOOL>COM -->
		<style type="text/css">
		
			input[type=text], select {
			  width: 100%;
			  padding: 12px 20px;
			  margin: 8px 0;
			  display: inline-block;
			  border: 1px solid #ccc;
			  border-radius: 4px;
			  box-sizing: border-box;
			}

			input[type=submit] {
			  background-color: #4CAF50;
			  color: white;
			  padding: 14px 20px;
			  margin: 8px 0;
			  border: none;
			  border-radius: 4px;
			  cursor: pointer;
			}
			.edit{
			  background-color: #aa298f;
			  color: white;
			  padding: 14px 20px;
			  margin: 8px 0;
			  border: none;
			  border-radius: 4px;
			  cursor: pointer;
			  text-decoration: none;	
			}

			input[type=submit]:hover {
			  background-color: #45a049;
			}

			#formStyle {
			  border-radius: 5px;
			  background-color: #f2f2f2;
			  padding: 20px;
			}		
			ul {
			  list-style-type: none;
			  margin: 0;
			  padding: 0;
			  overflow: hidden;
			  background-color: #333;
			}

			li {
			  float: left;
			}

			li a {
			  display: block;
			  color: white;
			  text-align: center;
			  padding: 14px 16px;
			  text-decoration: none;
			}

			li a:hover {
			  background-color: #111;
			}			
			.footer{
			  background-color:#333;
			  margin-top: 5px;
			  color:white;
			  padding:  5px 5px 1px 5px;
			}
			table {
			  margin-top: 5px;		
			  border-collapse: collapse;
			  border-spacing: 0;
			  width: 100%;
			  border: 1px solid #ddd;
			}

			th, td {
			  text-align: left;
			  padding: 16px;
			}

			tr:nth-child(even) {
			  background-color: #f2f2f2
			}
		</style>
	</head>
	<body>
		@include('includes.header')
		@include('includes.navigation')
		@yield('content')
		@include('includes.footer')
	</body>
</html>