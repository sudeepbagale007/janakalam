<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $sitedetail->title_en }} || Admin ||</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="apple-touch-icon" sizes="any" href="{{ $sitedetail->logo }}">
<link rel="icon" type="image/png" href="{{ $sitedetail->logo }}" sizes="any">

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" type="text/css" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> --}}
<!-- Ionicons -->
<link rel="stylesheet" type="text/css" href="{{ asset('admin/css/ionicons.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/jquery-ui/css/jquery-ui.css') }}" > --}}
  <!-- bootstrap wysihtml5 - text editor -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}"> --}}
{{--  AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load.  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/datatables/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/jasny/jasny-bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/fancybox/jquery.fancybox.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/jquery-confirm/jquery-confirm.min.css') }}">

<!-- Theme style -->
<link rel="stylesheet" type="text/css" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">  

<link rel="stylesheet" type="text/css" href="{{ asset('admin/style.css') }}">
@stack('style')

<script src="{{ asset('admin/assets/jquery-3.2.1/jquery-3.2.1.min.js') }}"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
  window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
  ]) !!};
</script>