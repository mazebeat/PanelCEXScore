<p>Y pata terminar, por favor complete con los siguientes datos:</p>
<article class="col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<div class="form-group">
		{{ Form::label('name', 'Nombre:', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Nombre...', 'pattern' => '^[a-zA-Z\s]+$', 'data-fv-regexp-message' => 'Debe contener solo letras')) }}
		</div>
	</div>
	<div class="messageContainer"></div>
	<div class="form-group">
		{{ Form::label('age', 'Edad:', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			{{ Form::number('age', Input::old('age'), array('class' => 'form-control', 'placeholder' => 'Edad...', 'data-fv-integer-message' => 'Debe ser un valor numerico', 'min' => 18, 'max' => 100, 'data-fv-lessthan-inclusive' => 'true', 'data-fv-lessthan-message' => 'Debe der menor o igual de 100', 'data-fv-greaterthan-inclusive' => 'true', 'data-fv-greaterthan-message' => 'Debe der mayor o igual a 18')) }}
		</div>
	</div>
	<div class="messageContainer"></div>
	<div class="form-group text-left">
		{{ Form::label('gender', 'Genero:', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			{{ Form::select('gender', array('' => '','F' => 'Femenino', 'M' => 'Masculino'), Input::old('gender'), array('id' => 'gender', 'class' => 'form-control', 'placeholder' => 'Genero...', 'data-fv-choice' => 'true' )) }}
		</div>
	</div>
	<div class="messageContainer"></div>
	<div class="form-group">
		{{ Form::label('email', 'Mail:', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-10">
			{{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Mail...', 'data-fv-emailaddress' => 'true', 'data-fv-message' =>"El mail no es valido")) }}
		</div>
	</div>
	<div class="messageContainer"></div>
	<div class="form-group">
		<div class="col-sm-10   ">
			<div class="checkbox">
				<label>{{ Str::hes('No quiero recibir información vía e-mail') }}&nbsp;&nbsp;{{ Form::checkbox('wish_email', 1, false, array('class' => 'form-control')) }}
				</label>
			</div>
		</div>
	</div>
	<div class="messageContainer"></div>
</article>