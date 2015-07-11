@extends('shorturl.template')

@section('content')
	<div class="row">
		<div class="alert alert-success">
			<h3>Here is your short url: </h3>
			<a href="{{ $url }}">{{ $url }}</a>
		</div>
	</div>
@stop