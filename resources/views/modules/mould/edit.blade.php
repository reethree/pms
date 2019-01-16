@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Mould</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('update-mould', $mould->id) }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" required value="{{$mould->name}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="no_of_cavity" class="col-sm-3 control-label">No. of Cavity</label>
                      <div class="col-sm-8">
                          <input type="number" name="no_of_cavity" class="form-control" id="no_of_cavity" placeholder="Number of Cavity" required value="{{$mould->no_of_cavity}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="price" class="col-sm-3 control-label">Price</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            <span class="input-group-addon">IDR</span>
                            <input type="number" name="price" class="form-control" id="price" placeholder="Price" required value="{{$mould->price}}">
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lifetime" class="col-sm-3 control-label">Lifetime</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            <input type="number" name="lifetime" class="form-control" id="lifetime" placeholder="Lifetime" required value="{{$mould->lifetime}}">
                            <span class="input-group-addon">Shot</span>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="photo" class="col-sm-3 control-label">Photo</label>
                      <div class="col-sm-8">
                          <input type="file" name="photo" class="form-control" id="photo">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="depreciation" class="col-sm-3 control-label">Depreciation</label>
                        <div class="col-sm-8">
                            <input type="checkbox" name="depreciation" @if($mould->depreciation == 1) checked @endif id="depreciation" value="1" />
                        </div>
                    </div>                              
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" style="width: 100%;">
                                <option value="active" @if($mould->status == 'active') selected="selected" @endif>Active</option>
                                <option value="inactive" @if($mould->status == 'inactive') selected="selected" @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    @if($mould->photo)
                        <img src="{{asset("uploads/mould/".$mould->photo)}}" width="300" />
                    @endif
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