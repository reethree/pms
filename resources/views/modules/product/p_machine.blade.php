<div class="col-sm-6" style="padding-left: 5px;">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Machine</h3>

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
                      <th>Name</th>
                      <!--<th>CT</th>-->
                      <th>Cost</th>
                      <th>Depr (Year)</th>
                      <th>Amount (Buffer)</th>
                      <th></th>
                    </tr>
                    <?php $i = 1;$total_machine = 0;?>
                    @foreach($product_machines as $product_machine)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$product_machine->machine_name}}</td>        
                      <!--<td>{{$product_machine->cycle_time}}</td>-->
                      <td>{{number_format($product_machine->depr_amount)}}</td>
                      <td align="center">{{$product_machine->depreciation}}</td>
                      <td>{{number_format($product_machine->amount)}}</td>
                      <td>
                          <a href="{{route('delete-product-detail', array($product_machine->id, 'machine'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php $total_machine += $product_machine->amount;$i++;?>
                    @endforeach
                    <tr>
                        <td colspan="5">Total Amount</td>
                        <td colspan="2"><b>{{number_format($total_machine)}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-machine-modal"><i class="fa fa-plus"></i> Add</button>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<!--MODAL MACHINE-->
<div class="modal fade" id="add-machine-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Machine</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-product-detail', array($product->id,'machine')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Machine</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id='machine_id' name="machine_id" style="width: 100%;">
                                        <option value="">Choose Machine</option>
                                        @foreach($machines as $machine)
                                            <option value="{{$machine->id}}" data-cost="{{$machine->price}}" data-purchase="{{$machine->purchase_year}}" data-depr="{{$machine->depreciation}}">{{$machine->name.' ('.$machine->brand.'-'.$machine->clamping_force.')'}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="purchase" class="col-sm-3 control-label">Purchase Year</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="purchase_year" placeholder="Purchase Year" readonly>
                                </div>
                                <label for="depreciation_info" class="col-sm-3 control-label">Depreciation</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="depreciation_info" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="machine_cost" class="col-sm-3 control-label">Cost</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost" class="form-control" id="machine_cost" placeholder="Machine Cost" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mould_buff" class="col-sm-3 control-label">Depreciation</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="number" name="depreciation" class="form-control" id="machine_depr" placeholder="Depreciation" value="5" required>
                                    <span class="input-group-addon">Year</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="machine_buff" class="col-sm-3 control-label">Amount (Buffer)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" class="form-control money" id="machine_buff" placeholder="Amount" required>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cycle Time</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="cycle_time" class="form-control timepicker" id="cycle_time" placeholder="Cycle Time" required>
                                        <span class="input-group-addon">Sec</span>                                    
                                    </div>
                                </div>
                            </div> -->
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