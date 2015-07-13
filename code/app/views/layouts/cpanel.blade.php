<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>@yield('title')</title>

	{{ HTML::style('css/bootstrap.min.css') }}

	{{ HTML::style('backend/css/bootstrap-flaty.min.css') }}    {{ HTML::style('backend/css/sb-admin.css') }}

	{{ HTML::style('backend/css/backend.min.css') }}

	{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}                            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>    <![endif]-->

</head>

<body>

<main id="wrapper">
	@include('layouts.modules.cpanel.top-menu')
	<section id="page-wrapper">
		<article class="container-fluid">
			@include('layouts.modules.cpanel.heading-page')
			@yield('content')
		</article>
	</section>
</main>{{ HTML::script('//code.jquery.com/jquery-1.11.0.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>