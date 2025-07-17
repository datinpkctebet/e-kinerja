
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Error 404 | Page Not Found</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<link href="{{ asset('css/pages/error/error-6.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="/media/logos/logotebet.png" />
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6" style="background-image: url(/media/error/bg7.jpg);">
			<div class="kt-error_container">
					<div class="kt-error_subtitle kt-font-dark">
							{{-- <h1>Oops...</h1> --}}
						</div>
						<p class="kt-error_description kt-font-dark">
							{{-- Looks like something went wrong.<br>
							We're working on it and we'll get it fixed as soon possible. --}}
						</p>
			</div>
		</div>
	</div>
</body>
</html>