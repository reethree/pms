@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Labour</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('update-labour', $labour->id) }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="number_of_employee" class="col-sm-3 control-label">No. of Employee</label>
                      <div class="col-sm-8">
                          <input type="number" name="number_of_employee" class="form-control" id="number_of_employee" placeholder="No. of Employee" value="{{$labour->number_of_employee}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="weekly_wages" class="col-sm-3 control-label">Monthly Wages</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            <span class="input-group-addon">IDR</span>
                            <input type="text" name="weekly_wages" class="form-control money" id="weekly_wages" placeholder="Weekly Wages" value="{{$labour->weekly_wages}}" required>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="work_hour" class="col-sm-3 control-label">Work Hour</label>
                      <div class="col-sm-8">
                          <input type="number" name="work_hour" class="form-control" id="work_hour" placeholder="Work Hour" value="{{$labour->work_hour}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="month" style="width: 100%;">
                                <option value="">Choose Month</option>
                                <option value="01" @if($labour->month == '01') selected @endif>January</option>
                                <option value="02" @if($labour->month == '02') selected @endif>February</option>
                                <option value="03" @if($labour->month == '03') selected @endif>March</option>
                                <option value="04" @if($labour->month == '04') selected @endif>April</option>
                                <option value="05" @if($labour->month == '05') selected @endif>May</option>
                                <option value="06" @if($labour->month == '06') selected @endif>June</option>
                                <option value="07" @if($labour->month == '07') selected @endif>July</option>
                                <option value="08" @if($labour->month == '08') selected @endif>August</option>
                                <option value="09" @if($labour->month == '09') selected @endif>September</option>
                                <option value="10" @if($labour->month == '10') selected @endif>October</option>
                                <option value="11" @if($labour->month == '11') selected @endif>November</option>
                                <option value="12" @if($labour->month == '12') selected @endif>December</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="year" style="width: 100%;">
                                <option value="">Choose Year</option>
                                <option value="2017" @if($labour->year == '2017') selected @endif>2017</option>
                                <option value="2018" @if($labour->year == '2018') selected @endif>2018</option>
                                <option value="2019" @if($labour->year == '2019') selected @endif>2019</option>
                            </select>
                        </div>
                    </div>
<!--                    <div class="form-group">
                      <label for="historical_date" class="col-sm-3 control-label">Historical Date</label>
                      <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="historical_date" class="form-control pull-right datepicker">
                            </div>
                      </div>
                    </div>-->
                </div>
                    
                <div class="col-md-6"> 
                    
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Update</button>
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