<section class="row">
	<article class="col-lg-12">
		<h1 class="page-header">
			@yield('page-title')
		</h1>
		<ol class="breadcrumb">
			@section('breadcrumb')
				<li>
					<i class="fa fa-dashboard"></i> <a href="{{ URL::to('admin/login') }}">Inicio</a>
				</li>
			@show
		</ol>
	</article>
</section>