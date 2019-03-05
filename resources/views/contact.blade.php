<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: 0">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Page | Polimerindo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset("bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("bower_components/font-awesome/css/font-awesome.min.css") }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset("bower_components/Ionicons/css/ionicons.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/dist/css/AdminLTE.min.css") }}">
  <!-- iCheck -->
<!--  <link rel="stylesheet" href="{{ asset("bower_components/admin-lte/plugins/iCheck/square/blue.css") }}">-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background: #f2f2f2;">
    <div class="login-box" style="width: 60%;margin: 30px auto;">
  <div class="login-logo">
    <a href="#">New Inquiry Customer Enquiry Form <b>(NICE Form)</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="color: #000;border: 1px solid #aeaeae;">
    @include('partials.alert') 
        
    @include('partials.form-alert')
    
    <form action="" method="post">
        {{ csrf_field() }}
        <h3>Contact Information</h3>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama" class="form-control" id="name" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Perusahaan</label>
                    <div class="col-sm-8">
                        <input type="text" name="perusahaan" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">No. HP/Tlp</label>
                    <div class="col-sm-8">
                        <input type="tel" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        
        <h3>Detail Inquiry</h3>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Barang</label>
                    <div class="col-sm-8">
                        <input type="text" name="barang" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Fungsi Barang</label>
                    <div class="col-sm-8">
                        <input type="text" name="fungsi_barang" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Material</label>
                    <div class="col-sm-8">
                        <input type="text" name="material" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Warna</label>
                    <div class="col-sm-8">
                        <input type="text" name="warna" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Mold</label>
                    <div class="col-sm-8">
                        <input type="text" name="mold" class="form-control" id="name" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Quantity / Bulan</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" name="quantity" class="form-control" required>
                            <span class="input-group-addon">PCS</span>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Rutin ?</label>
                    <div class="col-sm-8">
                        <input type="checkbox" name="rutin" value="1" checked />
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Target Harga /PCS</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon">IDR</span>
                            <input type="text" name="target_harga" class="form-control money">
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Target Tgl. Produksi</label>
                    <div class="col-sm-8">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="target_produksi" class="form-control datepicker" required>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Packaging</label>
                    <div class="col-sm-8">
                        <input type="text" name="packaging" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Alamat Pengiriman</label>
                    <div class="col-sm-8">
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Darimana anda mengetahui tentang PT. Dunamika Polimerindo ?</label>
                    <div class="col-sm-8">
                        <textarea name="referensi" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Catatan</label>
                    <div class="col-sm-8">
                        <textarea name="catatan" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Tanggal Tlp</label>
                    <div class="col-sm-8">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="tgl_tlp" class="form-control datepicker" required>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: flex;">
                    <label class="col-sm-3 control-label">Penerima Tlp</label>
                    <div class="col-sm-8">
                        <input type="text" name="penerima_tlp" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i> Submit</button>
            </div>
        </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
 <!--Datepicker--> 
<link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/datepicker/datepicker3.css") }}">
 <!--Bootstrap Switch--> 
<link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css") }}">

<!-- jQuery 3 -->
<script src="{{ asset("bower_components/jquery/dist/jquery.min.js") }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<!-- iCheck -->
<!--<script src="{{ asset("bower_components/admin-lte/plugins/iCheck/icheck.min.js") }}"></script>-->
<!-- Datepicker -->
<script src="{{ asset("/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset("bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js") }}"></script>
<script src="{{ asset("js/plugins/jquery.maskMoney.min.js") }}"></script>
<script type="text/javascript">
    
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
    
    $.fn.bootstrapSwitch.defaults.size = 'medium';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $.fn.bootstrapSwitch.defaults.onText = 'Ya';
    $.fn.bootstrapSwitch.defaults.offText = 'Tidak';
    
    $("input[type='checkbox']").bootstrapSwitch();
    
    $(".money").maskMoney({allowNegative: false, thousands:',', decimal:'.', affixesStay: false,precision: 0});
  
</script>
</body>
</html>
