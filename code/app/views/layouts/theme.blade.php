<script type="text/javascript">
</script>
<style type="text/css" media="all">
	header {
		background-color: {{ $theme->color_header }};
		color: {{ $theme->color_text_header }};
	}

	.header_text {
		color: {{ $theme->color_instrucciones }};
	}

	h2 small {
		color: {{ $theme->color_text_header }};
		font-weight: normal;
	}

	body {
		background-color: {{ $theme->color_body }};
	}

	#surveyForm input[type=submit], input[type=button], .btn {
		@if(isset($theme->color_boton) && $theme->color_boton != '')
			  background-color: {{ $theme->color_boton  }};
		@else
			  background-color: {{ $theme->color_text_header  }};
	@endif
}
	.survey_text {
		color: {{ $theme->color_text_body }};
	}

	.btn-primary, .label-primary, .alert-info {
		background-color: {{ $theme->color_body }};
	}

	footer {
		background-color: {{ $theme->color_body }};
		color: {{ $theme->color_text_body }};
	}
</style>