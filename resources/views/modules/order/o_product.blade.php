<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Product</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">  

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Product Name</th>
                  <th>Weight<br />(Buffer)</th>
                  <th>Efficiency<br />(Buffer)</th>
                  <th>Daily Quantity</th>
                  <th>Monthly Quantity</th>
                    <th>Mould (Cost)<br />per PCS</th>
                  <th>Machine (Cost)<br />per PCS</th>
                  <th>Material (Cost)<br />per PCS</th>
                  <th>Mould (Buffer)<br />per PCS</th>
                  <th>Machine (Buffer)<br />per PCS</th>
                  <th>Material (Buffer)<br />per PCS</th>
                  <th></th>
                </tr>
                <?php $i = 1;?>
                @foreach($order_product as $op)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$op->product_name}}</td>
                        <td>{{$op->weight_buff}}</td>
                        <td>{{$op->efficiency_buffer.'%'}}</td>
                        <td>{{number_format($op->daily_qty)}}</td>
                        <td>{{number_format($op->quantity)}}</td>
                        <td align="center">{{$op->mould_cost}}</td>
                        <td align="center">{{$op->machine_cost}}</td>
                        <td align="center">{{$op->material_cost}}</td>
                        <td align="center"><b>{{$op->mould_buffer}}</b></td>
                        <td align="center"><b>{{$op->machine_buffer}}</b></td>
                        <td align="center"><b>{{$op->material_buffer}}</b></td>
                        <td align="center">
                            <a href="{{route('delete-order-detail', array($op->id, 'product'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @if(count($op->machines) > 0)
                        <tr style="background: aquamarine;">
                            <th colspan="3">Machine Name</th>
                            <th colspan="3">Cycle Time</th>
                            <th colspan="3">Amount (Cost)</th>
                            <th colspan="3">Amount (Buffer)</th>
                        </tr>
                        @foreach($op->machines as $machine)
                        <tr>
                            <td colspan="3">{{$machine->machine_name}}</td>        
                            <td colspan="3" align="center">{{$machine->cycle_time}}</td>
                            <td colspan="3">{{number_format($machine->depr_amount)}}</td>
                            <td colspan="3">{{number_format($machine->amount)}}</td>
                        </tr>
                        @endforeach
                    @endif
                    @if(count($op->moulds) > 0)
                        <tr style="background: aquamarine;">
                            <th colspan="3">Mould Name</th>
                            <th colspan="3">Cavity</th>
                            <th colspan="3">Amount (Cost)</th>
                            <th colspan="3">Amount (Buffer)</th>
                        </tr>
                        @foreach($op->moulds as $mould)
                        <tr>
                            <td colspan="3">{{$mould->mould_name}}</td>
                            <td colspan="3" align="center">{{$mould->cavity}}</td>
                            <td colspan="3">{{number_format($mould->mould_cost)}}</td>
                            <td colspan="3">{{number_format($mould->mould_buff)}}</td>
                        </tr>
                        @endforeach  
                    @endif
                    <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-product-modal"><i class="fa fa-plus"></i> Add</button>
    </div>
    <!-- /.box-body -->
</div>
<!--MODAL MACHINE-->
<div class="modal fade" id="add-product-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Product</h4>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('update-order-detail',array($order->id,'product'))}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Product</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id='product_id' name="product_id" style="width: 100%;">
                                        <option value="">Choose Product</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="material_qty" class="col-sm-3 control-label">Daily Qty</label>
                                <div class="col-sm-8">
                                    <input type="text" name="daily_qty" class="form-control" id="daily_qty" placeholder="Daily Quantity Production">                                       
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="material_qty" class="col-sm-3 control-label">Monthly Qty</label>
                                <div class="col-sm-8">
                                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Monthly Quantity Needed" required>                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->