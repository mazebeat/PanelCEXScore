@extends('layouts.cpanel')

@section('title')
@endsection

@section('page-title')
	Generar URL Corta
@endsection

@section('breadcrumb')
	<li><a href="{{ url('admin/shorten') }}">Shorten</a></li>
	<li>Generate</li>
@endsection

@section('content')
	<section class="row">
		<article class="col-md-12 col-lg-12">
			@if(isset($survey) && isset($idplan))
				{{ Form::open(['action' => 'AdminController@modifySurvey', 'method' => 'POST', 'role' => 'form', 'id' => 'editSurvey', 'class' => '']) }}
				<fieldset>
					<legend>Preguntas encuesta <strong>"{{ $survey->titulo }}"</strong></legend>
					{{ Form::hidden('plan', Crypt::encrypt($idplan)) }}
					{{ Form::hidden('survey', Crypt::encrypt($survey->id_encuesta)) }}
					{{ Form::loadSurvey($survey, $idplan) }}
					@if($idplan != 1)
						{{ Form::submit('Modificar...', ['class' => 'btn btn-primary pull-right']) }}
					@endif
				</fieldset>
				{{ Form::close() }}
			@endif
		</article>
	</section>
@endsection

@section('style')
@endsection

@section('script')
@endsection