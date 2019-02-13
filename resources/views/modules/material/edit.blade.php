@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Material</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('update-material', $material->id) }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$material->name}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Brand</label>
                      <div class="col-sm-8">
                          <input type="text" name="brand" class="form-control" id="brand" placeholder="Brand" value="{{$material->brand}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="type" class="col-sm-3 control-label">Type</label>
                      <div class="col-sm-6">
                          <select class="form-control" name="type" id="type" style="width: 100%;" required>
                                <option value="">Choose Type</option>
                                @foreach($types as $type)
                                    <option value="{{$type->name}}" @if($material->type == $type->name) selected @endif>{{$type->name}}</option>
                                @endforeach
                            </select>
                      </div>
                      <div class="col-sm-2">
                            <button type="button" class="btn btn-info" id="add-type-btn">Add Type</button>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="price" class="col-sm-3 control-label">Price</label>
                      <div class="col-sm-3">
                            <select class="form-control" name="currency" id="currency" style="width: 100%;">
                                <option value="IDR" @if($material->currency == 'IDR') selected @endif>IDR</option>
                                <option value="USD" @if($material->currency == 'USD') selected @endif>USD</option>
                            </select>
                        </div>
                      <div class="col-sm-5">
                          <input type="text" name="price" class="form-control money_usd" id="price" placeholder="Price" value="{{$material->price}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">USD Rate</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon">IDR</span>
                                <input type="text" name="rate" class="form-control money" placeholder="Rate USD to IDR">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Date Price</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="date_price" class="form-control pull-right datepicker" value="{{date('Y-m-d')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" style="width: 100%;">
                                <option value="active" @if($material->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if($material->status == 'inactive') selected @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                    
                <div class="col-md-6"> 
                    <div class="box-body no-padding">
                        <table class="table table-bordered table-striped" style="margin-bottom: 10px;">
                            <tr>
                                <th>#</th>
                                <th style="text-align: center;">Date Price</th>
                                <th style="text-align: center;">Currency</th>
                                <th style="text-align: center;">Price</th>
                                <th style="text-align: center;">USD Rate</th>
                            </tr>
                            <?php $i = 1;$price_history = array();?>
                            @foreach($histories as $history)
                                <tr>
                                  <td>{{$i}}</td>
                                  <td align='center'>{{date('d F Y', strtotime($history->date))}}</td>
                                  <td align='center'>{{$history->currency}}</td>
                                  <td align='center'>@if($history->currency == 'IDR') {{number_format($history->price)}} @else {{$history->price}} @endif</td>   
                                  <td align='center'>{{number_format($history->rate)}}</td>
                                </tr>
                                <?php $i++;$price_history[]=$history->price;?>
                            @endforeach
                        </table>
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Save</button>
        </div>
        <!-- /.box-footer -->
    </form>
</div>

<div class="col-md-12">
    <!-- LINE CHART -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Price Chart</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="price-chart" style="height: 300px;"></div>
        </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

<div id="type-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="modal">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add New Type</h4>
            </div>
            <form class="form-horizontal">
                <div class="modal-body"> 
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Type Name</label>
                                <div class="col-sm-8">
                                    <input type="text" id="typename" name="typename" class="form-control" required /> 
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button id="store-type-btn" type="button" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('custom_css')

<!--Datepicker--> 
<link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/datepicker/datepicker3.css") }}">
<!--Bootstrap Switch--> 
<link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css") }}">
<!--Select2--> 
<link href="{{ asset("/bower_components/select2/dist/css/select2.min.css") }}" rel="stylesheet" />
<!-- Morris charts -->
<link rel="stylesheet" href="{{ asset("bower_components/morris.js/morris.css") }}">

@endsection

@section('custom_js')

<!-- Datepicker -->
<script src="{{ asset("/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<!-- Select2 -->
<script src="{{ asset("/bower_components/select2/dist/js/select2.min.js") }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset("bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js") }}"></script>

<!-- Morris.js charts -->
<script src="{{ asset("bower_components/raphael/raphael.min.js") }}"></script>
<script src="{{ asset("bower_components/morris.js/morris.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset("bower_components/fastclick/lib/fastclick.js") }}"></script>

<script type="text/javascript">
    $('select').select2(); 
    
    var min_price = '@if(count($price_history)>0){{ min($price_history) }}@else{{ 0 }}@endif';
    var max_price = '@if(count($price_history)>0){{ max($price_history) }}@else{{ 0 }}@endif';
    
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
    
    $("#add-type-btn").on("click", function(e){
        e.preventDefault();
        $("#type-modal").modal('show');
        return false;
    });
    
    $("#store-type-btn").on("click", function(e){
        e.preventDefault();

        var url = "{{ route('store-material-type') }}";

        $.ajax({
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: $('#typename').val()
            },
            dataType : 'json',
            url: url,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Something went wrong, please try again later.');
            },
            beforeSend:function()
            {

            },
            success:function(json)
            {
                if(json.success) {
//                    $('#btn-toolbar').showAlertAfterElement('alert-success alert-custom', json.message, 5000);
                    $("#type").append('<option value="'+json.data.name+'" selected="selected">'+json.data.name+'</option>');
                    $("#type").trigger('change');
                    $("#type-modal").modal('hide');
                } else {
//                    $('#btn-toolbar').showAlertAfterElement('alert-danger alert-custom', json.message, 5000);
                }
                
                return false;
            }
        });
        
        return false;
    });
    
    $(function () {
        "use strict";
        var data = '{{ $chart }}';
        console.log(JSON.parse(data.replace(/&quot;/g,'"')));
        // AREA CHART
        var area = new Morris.Area({
          element: 'price-chart',
          resize: false,
          data: JSON.parse(data.replace(/&quot;/g,'"')),
          xkey: 'y',
          ykeys: ['price'],
          labels: ['Price'],
          lineColors: ['#FF0000'],
          hideHover: 'auto',
          fillOpacity: 0.2,
          xLabels: 'day',
          ymin: parseInt(min_price)-1,
          ymax: parseInt(max_price)+1
        });
    });
    
</script>

@endsection