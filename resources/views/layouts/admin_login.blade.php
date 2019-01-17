<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('/theme') }}/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('/theme') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('/theme') }}/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('/theme') }}/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('/theme') }}/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="{{ asset('/theme') }}/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('/theme') }}/global_assets/js/main/jquery.min.js"></script>
	<script src="{{ asset('/theme') }}/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('/theme') }}/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('/theme') }}/assets/js/app.js"></script>
	<!-- /theme JS files -->

</head>

<body class="bg-slate-800"> 
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			 @yield('content')
			<!-- /content area -->

			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; @php echo date('Y'); @endphp  <a href="{{ route('admin') }}">{{ config('app.name', 'Laravel') }}</a>
					</span>

				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
