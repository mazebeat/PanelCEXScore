@extends('layouts.message')

@section('style')
	@if(isset($theme))
		@include('layouts.theme')
	@endif
	<style>
		.incentive img {
			margin-bottom: 10px;
		}
	</style>
@endsection

@section('header')
	<section class="row">
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
			{{ HTML::image($theme->logo_cliente_header, 'header-logo', array('class' => 'img-responsive center-block')) }} <h1>{{ $survey->titulo }}</h1>

			<h2>{{ $survey->slogan }}</h2>
		</article>
	</section>
@endsection

@section('content')
	@if(isset($theme) && !is_null($theme->logo_incentivo_header))
		<article class="row">
			<section class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-center-block placeholder">
				{{ HTML::image($theme->logo_incentivo_header, 'Incentivo', array('class' => 'img-responsive center-block')) }}
			</section>
		</article>
	@endif
	@if(isset($msg))
		<h1>{{ array_get($msg, 'title', '') }}</h1>
		<h4>{{ array_get($msg, 'subtitle', '') }}</h4>
{{--		{{ HTML::create_alert(array_get($msg, 'data', ''), array_get($msg, 'options', '')) }}--}}
	@endif
@stop

@section('footer')
	<section class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="text-center politicas">
				<small>Desarrollado por CustomerTrigger S.A. ©Todos los Derechos Reservados {{ Carbon::now()->year  }} Privacidad y Uso de la Información<br>
					<a href="{{ URL::to('politicas') }}">Privacidad y Uso de la Información</a></span><br>
					<a href="http://www.customertrigger.com" class="">www.CustomerTrigger.com</a> | +562 2219 8993 | Fanor Velasco 85, Piso 9, Santiago de Chile
				</small>
			</div>
		</div>
	</section>
@endsection


@section('script')
	<script type="text/javascript">
		@if(isset($script))
			{{ $script }}
		@endif
	</script>
@stop