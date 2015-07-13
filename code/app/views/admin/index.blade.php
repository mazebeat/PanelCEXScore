@extends('layouts.admin')

@section('title')
@endsection

@section('style')
	@if(isset($theme))
		@include('layouts.theme')
	@endif
@endsection

@section('content')
	<section class="row row-md-flex-center row-lg-flex-center" id="login">
		<article class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-center-block">
			@if ($errors->has())
				@if($errors->any())
					{{ HTML::alert('danger', $errors->all(), 'Atencion!...') }}
				@endif
			@endif
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">{{ e('Ingresa tu RUT') }}</h3>
				</div>
				<div class="panel-body">
					{{ Form::open(array('url' => 'admin', 'method' => 'POST', 'accept-charset' => 'UTF-8', 'role' => 'form', 'id' => 'loginForm')) }}
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
		</article>
	</section>
@endsection

@section('script')
@endsection