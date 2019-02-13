<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ $page_title or "Dashboard" }} | PMS Polimerindo</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    @yield('custom_css')
    
    <link rel="stylesheet" href="{{ asset("bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="{{ asset("bower_components/font-awesome/css/font-awesome.min.css") }}">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset("bower_components/Ionicons/css/ionicons.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/dist/css/AdminLTE.min.css") }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/dist/css/skins/skin-purple.min.css") }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    <!-- jQuery 3 -->
    <script src="{{ asset("bower_components/jquery/dist/jquery.min.js") }}"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset("bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("js/plugins/jquery.maskMoney.min.js") }}"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
        });

        function afterSubmitEvent(response, postdata)
        {
            //Parses the JSON response that comes from the server.
            result = JSON.parse(response.responseText);
            console.log(result);
            //result.success is a boolean value, if true the process continues,
            //if false an error message appear and all other processing is stopped,
            //result.message is ignored if result.success is true.
            return [result.success, result.message];
        }
    </script>

</head>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
    
    @include('partials.header')
  
    @include('partials.main-menu')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          {{ $page_title or "Access Denied" }}
          <small>{{ $page_description or null }}</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          @if(isset($breadcrumbs))
              @foreach($breadcrumbs as $breadcrum)
                  @if($breadcrum['action'])
                      <li><a href="{{ $breadcrum['action'] }}">{{ $breadcrum['title'] }}</a></li>
                  @else
                      <li class="active">{{ $breadcrum['title'] }}</li>
                  @endif
              @endforeach
          @endif
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @include('partials.alert') 
        
        @include('partials.form-alert')
        
        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
<!--    <div class="pull-right hidden-xs">
      Anything you want
    </div>-->
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="#">PT. Dinamika Polimerindo</a>.</strong> All rights reserved.
  </footer>

  @include('partials.rightbar') 
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="{{ asset("bower_components/admin-lte/dist/js/adminlte.js") }}"></script>
<script src="{{ asset("bower_components/admin-lte/dist/js/demo.js") }}"></script>

<script>
    $(".pagination").addClass("pagination-sm no-margin pull-right");
    $(".money").maskMoney({allowNegative: false, thousands:',', decimal:'.', affixesStay: false,precision: 0});
    $(".money_usd").maskMoney({allowNegative: false, thousands:',', decimal:'.', affixesStay: false,precision: 2});
</script>

@yield('custom_js')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>