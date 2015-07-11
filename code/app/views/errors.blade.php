@extends('layouts.message')

@section('style')
<style type="text/css">
.code_error {
font-size: 9vw;
}
</style>
@stop

@section('content')
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
	@if ($errors->has())
		@if($errors->any())
			{{ HTML::alert('danger', $errors->all(), null) }}
		@endif
	@endif
	@if(isset($code))
	    <h3 class="text-center">Oops! Sentimos la molestia</h3>
	    <h1 class="text-center text-uppercase code_error">Error! <i class="fa fa-terminal fa"></i><strong>{{ $code or '' }}</strong></h1>
	@endif
</div>
@stop