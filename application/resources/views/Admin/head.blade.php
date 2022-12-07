<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{$title}}</title>
<script src="{{asset('backend/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{asset('backend/admin/plugins/fontawesome-free/css/all.min.css')}}"  rel="stylesheet">
<!-- icheck bootstrap -->
<link href="{{asset('backend/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"  rel="stylesheet">
<!-- Theme style -->
<link href="{{asset('backend/admin/dist/css/adminlte.min.css')}}"rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('head')
