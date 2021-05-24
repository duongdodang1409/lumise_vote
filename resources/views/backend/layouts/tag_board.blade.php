<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="_token" content="{{ csrf_token() }}">
	<title>Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

	<link rel="stylesheet" href="{{asset('backend/css/subdomainBundle.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/ChangelogWidgetBundle.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
</head>
<body>
    
	@include('backend.layouts.head')
	
	@yield('Content')


	@include('backend.layouts.footer')


	<script type="text/javascript" src="{{asset('backend/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/popper.js')}}"></script>
	<!-- <script type="text/javascript" src="{{('backend/dist/asset/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
	<script type="text/javascript" src="{{('backend/dist/asset/jquery-file-upload/js/jquery.iframe-transport.js')}}"></script>
	<script type="text/javascript" src="{{('backend/dist/asset/jquery-file-upload/js/jquery.fileupload.js')}}"></script> -->

	

	<script type="text/javascript" src="{{asset('backend/js/main.js')}}"></script>

<script type="text/javascript">
</script>

</body>
</html>