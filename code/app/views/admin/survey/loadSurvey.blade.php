@extends('layouts.cpanel')

@section('title')
@endsection

@section('page-title')
	<i class="fa fa-question fa-fw"></i>Modificar Preguntas
@endsection

@section('breadcrumb')
	@parent
	<li>Preguntas</li>
	<li><a href="{{ url('admin/survey/load') }}">Modificar</a></li>
@endsection

@section('content')
	@if($errors->has())
		<div class="row">
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<ul>
					@foreach($errors->all() as $message)
						<li>{{$message}}</li>
					@endforeach
				</ul>
			</div>
		</div>
	@endif
	<section class="row">
		<article class="col-md-12 col-lg-12">
			@if(isset($survey) && isset($idplan))
				{{ Form::open(['action' => 'AdminController@modifySurvey', 'method' => 'POST', 'role' => 'form', 'id' => 'editSurvey', 'class' => '']) }}
				<fieldset>
					<legend>Preguntas encuesta <strong>"{{ $survey->titulo }}"</strong></legend> {{ Form::hidden('plan', Crypt::encrypt($idplan)) }}
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