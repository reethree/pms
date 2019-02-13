@extends('main-layout')

@section('content')
      
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Material</h3>
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{ route('store-material') }}" enctype="multipart/form-data" method="POST">
        <div class="box-body">            
            <div class="row">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-8">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Brand</label>
                      <div class="col-sm-8">
                          <input type="text" name="brand" class="form-control" id="brand" placeholder="Brand" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="type" class="col-sm-3 control-label">Type</label>
                      <div class="col-sm-6">
                          <select class="form-control" name="type" id="type" style="width: 100%;" required>
                                <option value="">Choose Type</option>
                                @foreach($types as $type)
                                    <option value="{{$type->name}}">{{$type->name}}</option>
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
                                <option value="IDR" selected="selected">IDR</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                      <div class="col-sm-5">
                            <input type="text" name="price" class="form-control money_usd" id="price" placeholder="Price" required>
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
                                <input type="text" name="date_price" class="form-control pull-right datepicker" required value="{{date('Y-m-d')}}">
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
                    
                <div class="col-md-6"> 

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
    
</script>

@endsection