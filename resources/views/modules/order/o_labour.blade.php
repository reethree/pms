<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Labour</h3>

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
                  <th>Year</th>
                  <th>Cost per Month</th>
                  <th>Buffer per Month</th>
                  <th>Days Needed</th>
                  @if(\Auth::user()->role == 'owner')
                  <th>Labour (Cost)<br />per PCS</th>
                  @endif
                  <th>Labour (Buffer)<br />per PCS</th>
                  <th></th>
                </tr>
                <?php $i = 1;?>
                @foreach($order_labour as $ol)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$ol->year}}</td>
                    <td>{{number_format($ol->cost_head)}}</td>
                    <td>{{number_format($ol->amount)}}</td>
                    <td align="center">{{$ol->qty}}</td>
                    @if(\Auth::user()->role == 'owner')
                    <td align="center">{{$ol->labour_cost}}</td>
                    @endif
                    <td align="center"><b>{{$ol->labour_pcs}}</b></td>
                    <td align="center">
                        <button type="button" class="btn btn-info btn-xs edit-labour-btn" data-id="{{$ol->id}}" data-qty="{{$ol->qty}}" data-cost="{{$ol->cost_head}}" data-buffer="{{$ol->amount}}"><i class="fa fa-edit"></i></button>
                        <a href="{{route('delete-order-detail', array($ol->id, 'labour'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-labour-modal"><i class="fa fa-plus"></i> Add</button>
    </div>
    <!-- /.box-body -->
</div>
<!--MODAL LABOUR-->
<div class="modal fade" id="add-labour-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Labour</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'labour')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Year</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="labour_year" name="year" style="width: 100%;">
                                        <option value="">Choose Year</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wages_avg" class="col-sm-3 control-label">Avg per Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost" class="form-control" id="wages_avg" placeholder="Wages Average" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="cost_per_shift" class="col-sm-3 control-label">Cost /Day</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="shift" class="form-control" id="cost_per_shift" placeholder="Cost per Day" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cost Head /Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost_head" class="form-control" id="cost_head" placeholder="Cost Head /Month" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="col-sm-3 control-label">Cost Head /Day</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost_head_day" class="form-control" id="cost_head_day" placeholder="Cost Head /Day" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qty_shift" class="col-sm-3 control-label">Days Production</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control qty_prod" name="qty_actual" placeholder="Production Quantity" required readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qty_shift" class="col-sm-3 control-label">Days Needed</label>
                                <div class="col-sm-8">
                                    <input type="text" name="qty" class="form-control" id="qty_shift" placeholder="Days Needed" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount_per_shift" class="col-sm-3 control-label">Buffer /Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" class="form-control money" id="amount_per_shift" placeholder="Buffer Head /Month" required>
                                    </div>
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

<div class="modal fade edit-labour-modal" id="edit-labour-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Labour</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'labour')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"> 
                            <input name="id" type="hidden" id="edit_labour_id"> 
                            <div class="form-group">
                                <label for="qty_shift" class="col-sm-3 control-label">Days Needed</label>
                                <div class="col-sm-8">
                                    <input type="text" name="qty" class="form-control" id="edit_labour_qty" placeholder="Days Needed" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cost Head /Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost_head" class="form-control money" id="edit_labour_cost" placeholder="Cost Head /Month" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount_per_shift" class="col-sm-3 control-label">Buffer /Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" class="form-control money" id="edit_labour_buffer" placeholder="Buffer Head /Month" required>
                                    </div>
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