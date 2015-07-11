@extends('shorturl.template')

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
	<div class="row">
		<div class="shortit">
			{{Form::open(array('url' => 'shorten', 'method' => 'POST', 'class' => 'form-search'))}}
			<div class="form-group">
				<div id="custom-search-input">
					<div class="input-group col-md-12">
						{{ Form::select2('client', $clients, Input::old('client'), ['class' => 'form-control input-lg', 'placeholder' => 'Cliente...']) }}
					</div>
				</div>
			</div>
			<div class="form-group">
				<div id="custom-search-input">
					<div class="input-group col-md-12">
						{{ Form::select2('canal', $canals, Input::old('canal'), ['class' => 'form-control input-lg', 'placeholder' => 'Canal...']) }}
					</div>
				</div>
			</div>
			<hr>
			<div class="form-group">
				<div id="custom-search-input">
					<div class="input-group col-md-12">
						{{Form::url('url',null, array('placeholder' => 'Paste a link...', 'class' => 'form-control input-lg'))}}

						<div class="input-group-btn">
							<button class="btn btn-info btn-lg" type="submit">
								<i class="fa fa-magic"></i>
							</button>
						</div>
					</div>
				</div>
			</div> {{Form::close()}}
		</div>
	</div>
@stop