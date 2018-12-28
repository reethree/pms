@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Product</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('store-product') }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Customer</label>
                        <div class="col-sm-8">
                            <select class="form-control" id='customer_id' name="customer_id" style="width: 100%;">
                                <option value="">Choose Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Product Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="weight" class="col-sm-4 control-label">Weight (Prediction)</label>
                      <div class="col-sm-4">
                          <div class="input-group">
                          <input type="text" name="weight_pre" class="form-control" id="weight_pre" required>
                          <span class="input-group-addon">Gram</span>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="weight" class="col-sm-4 control-label">Weight (Buffer)</label>
                      <div class="col-sm-4">
                          <div class="input-group">
                          <input type="text" name="weight_buff" class="form-control" id="weight_buff" required>
                          <span class="input-group-addon">Gram</span>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="efficiency_actual" class="col-sm-4 control-label">Efficiency (Actual)</label>
                      <div class="col-sm-4">
                          <div class="input-group">
                          <input type="number" name="efficiency_actual" class="form-control" id="efficiency_actual" required>
                          <span class="input-group-addon">%</span>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="efficiency_buffer" class="col-sm-4 control-label">Efficiency (Buffer)</label>
                      <div class="col-sm-4">
                          <div class="input-group">
                          <input type="number" name="efficiency_buffer" class="form-control" id="efficiency_buffer" required>
                          <span class="input-group-addon">%</span>
                          </div>
                      </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" style="width: 100%;">
                                <option value="active" selected="selected">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                    
<!--                <div class="col-md-6"> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Material Group</label>
                        <div class="col-sm-8">
                            <select class="form-control" id='material_group_id' name="material_group_id" style="width: 100%;">
                                <option value="">Choose Group</option>
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>-->
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