@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Machine</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('update-machine', $machine->id) }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" required value="{{$machine->name}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="brand" class="col-sm-3 control-label">Brand</label>
                      <div class="col-sm-8">
                          <input type="text" name="brand" class="form-control" id="brand" placeholder="Brand" required value="{{$machine->brand}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="price" class="col-sm-3 control-label">Price</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            <span class="input-group-addon">IDR</span>
                            <input type="text" name="price" class="form-control money" id="price" placeholder="Price" required value="{{$machine->price}}">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="clamping_force" class="col-sm-3 control-label">Clamping Force</label>
                      <div class="col-sm-8">
                        <div class="input-group">
                            <input type="number" name="clamping_force" class="form-control" id="clamping_force" placeholder="Clamping Force" required value="{{$machine->clamping_force}}">
                            <span class="input-group-addon">Ton</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="purchase_year" class="col-sm-3 control-label">Purchase Year</label>
                      <div class="col-sm-8">
                          <input type="number" name="purchase_year" class="form-control" id="purchase_year" placeholder="Purchase Year" required value="{{$machine->purchase_year}}">
                      </div>
                    </div>
                </div>
                    
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="depreciation" class="col-sm-3 control-label">Depreciation</label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="depreciation" @if($machine->depreciation == 1) checked @endif id="depreciation" value="1" />
                        </div>
                    </div>           
<!--                    <div class="form-group">
                      <label for="depreciation_finish" class="col-sm-3 control-label">Depreciation Finish</label>
                      <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="depreciation_finish" class="form-control pull-right datepicker">
                            </div>
                      </div>
                    </div>-->
                    <div class="form-group">
                      <label for="production_year" class="col-sm-3 control-label">Production Year</label>
                      <div class="col-sm-8">
                          <input type="number" name="production_year" class="form-control" id="production_year" placeholder="Production Year" value="{{$machine->production_year}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="photo" class="col-sm-3 control-label">Photo</label>
                      <div class="col-sm-8">
                          <input type="file" name="photo" class="form-control" id="photo">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" style="width: 100%;">
                                <option value="active" @if($machine->status == 'active') selected="selected" @endif>Active</option>
                                <option value="inactive" @if($machine->status == 'inactive') selected="selected" @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    @if($machine->photo)
                        <img src="{{asset("uploads/machine/".$machine->photo)}}" width="300" />
                    @endif
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