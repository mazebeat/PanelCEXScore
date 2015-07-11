@extends('layouts.user')

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
			<section class="row">
				<article class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-center-block">
					{{ HTML::image($theme->logo_header, 'header-logo', array('class' => 'img-responsive center-block')) }}
				</article>
			</section>
			<h1>{{ $survey->titulo }}</h1>

			<h2>{{ $survey->slogan }}</h2>
		</article>
	</section>
@endsection

@section('content')
	<section class="row">
		<article class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 text-left header_text">
			<h4>{{ $survey->description }}</h4>
			<h4>Luego de completar la encuesta, presiona <em>"Enviar"</em></h4>
		</article> @if(isset($theme) && !is_null($theme->logo_incentivo_header))
			<article class="row">
				<section class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-center-block">
					{{ HTML::image($theme->logo_incentivo_header, 'Incentivo', array('class' => 'img-responsive center-block')) }}
				</section>
			</article>
		@endif
		<article class="panel panel-primary col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 survey_text">
			<section class="panel-body">
				@if ($errors->has())
					<article class="errors">
						@if($errors->any())
							{{ HTML::alert('danger', $errors->all(), 'Error...') }}
						@endif
					</article>
				@endif
				{{ Form::open(array('url' => 'encuestas', 'method' => 'POST', 'accept-charset' => 'UTF-8', 'role' => 'form', 'id' => 'surveyForm', 'class' => 'form-horizontal')) }}
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<section class="row">
						{{ HTML::generateSurvey($survey) }}
					</section>
				</article> @if(isset($theme))
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						@include('layouts.form_cliente')
					</article>
				@endif
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					{{ Form::submit('Enviar Respuestas', array('class' => 'text-uppercase btn btn-lg center-block user'))  }}
				</article> {{ Form::close() }}
			</section>
		</article>
	</section>
@endsection

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
		var $username = '{{ Session::get('user_name') }}';
		var $color = '{{ $theme->color_inputs }}';
	</script>
	{{ HTML::script('js/survey.min.js') }}
@endsection
