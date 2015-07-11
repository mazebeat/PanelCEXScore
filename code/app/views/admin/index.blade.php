@extends('layouts.admin')

@section('title')
@endsection

@section('page-title')
@endsection

@section('breadcrumb')
	@parent
	<li class="active"></li>
@endsection

@section('content')
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-sm-offset-3 col-md-offset-4 col-lg-offset-4" id="login_umayor">
		<h1 class="text-center"></h1> @if ($errors->has())
			@if($errors->any())
				{{ HTML::alert('danger', $errors->all(), null) }}
			@endif
		@endif
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">{{ e('Ingresa tu RUT') }}</h3>
			</div>
			<div class="panel-body">
				{{ Form::open(array('url' => 'admin', 'method' => 'POST', 'accept-charset' => 'UTF-8', 'role' => 'form', 'id' => 'login_form')) }}
				<fieldset>
					<div class="form-group">
						<input class="form-control" placeholder="{{ e('Ingresar RUT sin puntos ni gui&oacute;n') }}" name="rut" id="rut_field" type="text" maxlength="9" autocomplete="off" required>
						<span class="help-block text-muted">
							<em class="">{{ e('Ejemplo: 111111111') }}</em>
							<em class="pull-right">{{ e('') }}</em>
						</span>
					</div>
					<input class="btn btn-lg btn-hot btn-block text-uppercase" type="submit" value="Entrar">
				</fieldset> {{ Form::close()  }}
			</div>
		</div>
	</div>
@endsection

@section('style')
@endsection

@section('script')
@endsection