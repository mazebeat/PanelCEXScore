<!DOCTYPE html>
<html lang="en">
<head>
	<title>Laravel Shorturl</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content=""> {{ HTML::style('css/bootstrap.min.css') }}
	<style type="text/css">
		body {
			padding-top: 20px;
			padding-bottom: 40px;
		}

		.container-narrow {
			margin: 0 auto;
			max-width: 700px;
		}

		.container-narrow > hr {
			margin: 30px 0;
		}

		.jumbotron {
			margin: 60px 0;
			text-align: center;
		}

		.jumbotron h1 {
			font-size: 72px;
			line-height: 1;
		}

		.jumbotron .btn {
			font-size: 21px;
			padding: 14px 24px;
		}

		.shortit {
			text-align: center;
		}

		#custom-search-input {
			padding: 3px;
			border: solid 1px #E4E4E4;
			border-radius: 6px;
			background-color: #fff;
		}

		input, select {
			border: 0;
			box-shadow: none;
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
		}

		#custom-search-input input, #custom-search-input select {
			border: 0;
			box-shadow: none;
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
		}

		#custom-search-input button {
			margin: 2px 0 0 0;
			background: none;
			box-shadow: none;
			border: 0;
			color: #666666;
			/*padding: 0 8px 0 10px;*/
			border-left: solid 1px #ccc;
		}

		#custom-search-input button:hover {
			border: 0;
			box-shadow: none;
			border-left: solid 1px #ccc;
		}

		#custom-search-input .glyphicon-search {
			font-size: 23px;
		}

	</style>
</head>
<body>
<header class="container-narrow">
	<div class="masthead">
		<h3 class="muted">Generate short URL</h3>
	</div>
</header>
<hr>
<main class="container-narrow">
	@yield('content')
</main>
<hr>
<footer class="container-narrow">
	<div class="footer">
		{{ Carbon::now()->year  }} | MazeBeat Productions!
	</div>
</footer> {{ HTML::script('http://code.jquery.com/jquery-latest.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>