@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Order</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('store-order') }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    
                    <div class="form-group">
                      <label for="number" class="col-sm-3 control-label">Order Number</label>
                      <div class="col-sm-8">
                          <input type="text" name="number" class="form-control" id="number" placeholder="Order Number" value="{{$order->number}}" required>
                      </div>
                    </div>
                </div>
                    
                <div class="col-md-6"> 
                    
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="{{ route('preview-order', $order->id) }}" class="btn btn-danger"><i class="fa fa-check"></i> Order Preview</a>
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Update</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

@include('modules.order.o_product')

@include('modules.order.o_labour')
    
@include('modules.order.o_electricity')

@include('modules.order.o_packaging')

@include('modules.order.o_transport')

@include('modules.order.o_overhead')
    
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
    
    $("#labour_year").on("change", function(){
        var year = $(this).val();
        var url = '{{route("getDataLabourByYear")}}';
        var order_id = '{{$order->id}}';
        $.ajax({
            type: 'GET',
            data: {'year': year,'order_id': order_id},
            dataType : 'json',
            url: url,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            success:function(json)
            {      
                console.log(json);
                $('#wages_avg').val(json.cost_monthly);
                $('#cost_per_shift').val(json.shift_labour);
                $('#cost_head').val(json.avg_labour);
                $('#cost_head_day').val(json.cost_head_day);
                $('#qty_prod').val(json.qty_prod);
            }
        });
    });
    
    $("#electricity_year").on("change", function(){
        var year = $(this).val();
        var url = '{{route("getDataElectricityByYear")}}';
        $.ajax({
            type: 'GET',
            data: {'year' : year},
            dataType : 'json',
            url: url,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            success:function(json)
            {      
                console.log(json);
                $('#max_bill').val(json.max_bill);
                $('#min_bill').val(json.min_bill);
                $('#avg_bill').val(json.avg_bill);
            }
        });
    });
    
    $("#overhead_year").on("change", function(){
        var year = $(this).val();
        var url = '{{route("getDataOverheadByYear")}}';
        $.ajax({
            type: 'GET',
            data: {'year' : year},
            dataType : 'json',
            url: url,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            success:function(json)
            {      
                console.log(json);
                $('#overhead_max').val(json.max);
                $('#overhead_min').val(json.min);
                $('#overhead_avg').val(json.avg);
            }
        });
    });
  
</script>

@endsection