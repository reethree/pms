@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Managenent Fees</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('store-fees') }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    
                    <div class="form-group">
                      <label for="monthly_revenue" class="col-sm-3 control-label">Monthly Update</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            <span class="input-group-addon">IDR</span>
                            <input type="text" name="monthly_revenue" class="form-control money" id="monthly_revenue" placeholder="Monthly Update" required>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="month" style="width: 100%;">
                                <option value="">Choose Month</option>
                                <option value="01" @if(date('m') == '01') selected @endif>January</option>
                                <option value="02" @if(date('m') == '02') selected @endif>February</option>
                                <option value="03" @if(date('m') == '03') selected @endif>March</option>
                                <option value="04" @if(date('m') == '04') selected @endif>April</option>
                                <option value="05" @if(date('m') == '05') selected @endif>May</option>
                                <option value="06" @if(date('m') == '06') selected @endif>June</option>
                                <option value="07" @if(date('m') == '07') selected @endif>July</option>
                                <option value="08" @if(date('m') == '08') selected @endif>August</option>
                                <option value="09" @if(date('m') == '09') selected @endif>September</option>
                                <option value="10" @if(date('m') == '10') selected @endif>October</option>
                                <option value="11" @if(date('m') == '11') selected @endif>November</option>
                                <option value="12" @if(date('m') == '12') selected @endif>December</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="year" style="width: 100%;">
                                <option value="">Choose Year</option>
                                <option value="2017" @if(date('Y') == '2017') selected @endif>2017</option>
                                <option value="2018" @if(date('Y') == '2018') selected @endif>2018</option>
                                <option value="2019" @if(date('Y') == '2019') selected @endif>2019</option>
                            </select>
                        </div>
                    </div>
                </div>
                    
                <div class="col-md-6"> 
                    
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Create</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
    
@endsection

@section('custom_css')

 <!--Datepicker--> 
<link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/datepicker/datepicker3.css") }}">
 <!--Bootstrap Switch--> 
<link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css") }}">
 <!--Select2--> 
<link href="{{ asset("/bower_components/select2/dist/css/select2.min.css") }}" rel="stylesheet" />

@endsection

@section('custom_js')

<!-- Datepicker -->
<script src="{{ asset("/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<!-- Select2 -->
<script src="{{ asset("/bower_components/select2/dist/js/select2.min.js") }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset("bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js") }}"></script>

<script type="text/javascript">
    $('select').select2(); 
    
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
    
    $.fn.bootstrapSwitch.defaults.size = 'small';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $.fn.bootstrapSwitch.defaults.onText = 'Yes';
    $.fn.bootstrapSwitch.defaults.offText = 'No';
    
    $("input[type='checkbox']").bootstrapSwitch();
  
</script>

@endsection