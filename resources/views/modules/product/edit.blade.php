@extends('main-layout')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Form Product</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" action="{{ route('update-product', $product->id) }}" enctype="multipart/form-data" method="POST">
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
                                            <option value="{{$customer->id}}" @if($product->customer_id == $customer->id) selected="selected" @endif>{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="name" class="col-sm-3 control-label">Product Name</label>
                              <div class="col-sm-8">
                                  <input type="text" name="name" class="form-control" id="name" placeholder="Name" required value="{{$product->name}}">
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="weight" class="col-sm-4 control-label">Weight (Prediction)</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="weight_pre" class="form-control" id="weight_pre" value="{{$product->weight_pre}}" required>
                                    <span class="input-group-addon">Gram</span>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="weight" class="col-sm-4 control-label">Weight (Buffer)</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="weight_buff" class="form-control" id="weight_buff" value="{{$product->weight_buff}}" required>
                                    <span class="input-group-addon">Gram</span>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="efficiency_actual" class="col-sm-4 control-label">Efficiency (Actual)</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="number" name="efficiency_actual" class="form-control" id="efficiency_actual"  value="{{$product->efficiency_actual}}" required>
                                    <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="efficiency_buffer" class="col-sm-4 control-label">Efficiency (Buffer)</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="number" name="efficiency_buffer" class="form-control" id="efficiency_buffer" value="{{$product->efficiency_buffer}}" required>
                                    <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                              </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option value="active" @if($product->status == 'active') selected='selected' @endif>Active</option>
                                        <option value="inactive" @if($product->status == 'inactive') selected='selected' @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

<!--                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Material Group</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id='material_group_id' name="material_group_id" style="width: 100%;">
                                        <option value="">Choose Group</option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}" @if($product->material_group_id == $group->id) selected="selected" @endif>{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Update</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    
    @include('modules.product.p_material')
    
    @include('modules.product.p_mould')
    
    @include('modules.product.p_machine')
    
</div>      


@endsection

@section('custom_css')

 <!--Datepicker--> 
<link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/datepicker/datepicker3.css") }}">
 <!--Timepicker--> 
<!--<link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.css") }}">-->
 <!--Bootstrap Switch--> 
<link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css") }}">
 <!--Select2--> 
<link href="{{ asset("/bower_components/select2/dist/css/select2.min.css") }}" rel="stylesheet" />

@endsection

@section('custom_js')

<!-- Datepicker -->
<script src="{{ asset("/bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<!-- Timepicker -->
<!--<script src="{{ asset("/bower_components/admin-lte/plugins/timepicker/bootstrap-timepicker.js") }}"></script>-->
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
//    $('.timepicker').timepicker({ 
//        showMeridian: false,
////        showInputs: false,
//        showSeconds: true,
//        defaultTime: '00:00:00',
//        minuteStep: 1,
//        secondStep: 10
//    });
    $.fn.bootstrapSwitch.defaults.size = 'small';
    $.fn.bootstrapSwitch.defaults.onColor = 'danger';
    $.fn.bootstrapSwitch.defaults.onText = 'Yes';
    $.fn.bootstrapSwitch.defaults.offText = 'No';
    
    $("input[type='checkbox']").bootstrapSwitch();
    
    // MATERIAL
    $("#material_id").on("change", function(){
        var price = $(this).find(':selected').data('cost');
        var curr = $(this).find(':selected').data('curr');
//        var rate = $("#usd_rate").val();
        var rate = $(this).find(':selected').data('rate');
        var cost = price;
        
        if(rate){
            $("#usd_rate").val(rate);
        }else{
            $("#usd_rate").val(0);
        }
        
        $("#material_price").val(price);
        $("#currency").html(curr);
        
        if(curr == 'USD'){
            cost = price*rate;
        }        
        $("#material_cost").val(cost);
    });
    $("#usd_rate").on("change", function(){
        var rate = $(this).val();
        var curr = $('#material_id').find(':selected').data('curr');
        var price = $('#material_id').find(':selected').data('cost');
        
        var cost = price;
        
        if(curr == 'USD'){
            cost = price*rate;
        }        
        $("#material_cost").val(cost);
    });
    $("#save-group-material").on("click", function(){
//        var ids = $(this).data('id');
//        var group_id = $(this).data('groupid');

        $('#save-group-modal').modal('show');

//        if (confirm("Are you sure want to save this material to group?") == false) {
//            return false;
//        }
        
//        $.ajax({
//            type: 'GET',
//            data: {'ids' : ids, 'group_id': group_id, 'product_id': '{{$product->id}}', 'product_name': '{{$product->name}}'},
//            dataType : 'json',
//            url: url,
//            error: function (jqXHR, textStatus, errorThrown)
//            {
//                alert('Something went wrong, please try again later.');
//            },
//            success:function(json)
//            {      
//                console.log(json);
//                if(json.success == true){
//                    $("#save-group-material").attr('data-groupid', json.group_id);
//                    alert(json.msg);
//                }else{
//                    alert(json.msg);
//                }
//            }
//        });
    });
    $(".edit-material-btn").on("click", function(){
        var product_material_id = $(this).data('id');
        var cost = $(this).data('cost');
        var weight = $(this).data('qty');
        
        $('#product_material_id').val(product_material_id);
        $('#material_cost_edit').val(cost);
        $('#material_qty_edit').val(weight);
        
        $('#edit-material-modal').modal('show');
    });
    
    // MOULD
    $("#mould_id").on("change", function(){
        $("#mould_cost").val($(this).find(':selected').data('cost'));
    });
    
    // MACHINE
    $("#machine_id").on("change", function(){
        var cost = $(this).find(':selected').data('cost');
        var purchase = $(this).find(':selected').data('purchase');
        var depr = $(this).find(':selected').data('depr');
        var derp = $('#machine_depr').val();
        var amount = parseInt(cost) / parseInt(derp);
        
        if(depr == 1){
            $("#depreciation_info").val('Yes');
        }else{
            $("#depreciation_info").val('No');
        }

        $("#purchase_year").val(purchase);
        $("#machine_cost").val(cost);
        $("#machine_buff").val(amount);
    });
    $("#machine_depr").on("change", function(){
        var derp = $(this).val();
        var cost = $("#machine_cost").val();
        var amount = parseInt(cost) / parseInt(derp);
        
        $("#machine_buff").val(amount);
    });
  
</script>

@endsection