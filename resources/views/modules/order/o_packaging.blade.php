<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Packaging</h3>

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
                  <th>Packaging Name</th>
                  <th>Quantity</th>
                  @if(\Auth::user()->role == 'owner')
                  <th>Packaging Cost</th>
                  @endif
                  <th>Packaging Amount</th>
                  @if(\Auth::user()->role == 'owner')
                  <th>Packaging (Cost)<br />per PCS</th>
                  @endif
                  <th>Packaging (Buffer)<br />per PCS</th>
                  <th></th>
                </tr>
                <?php $i = 1;?>
                @foreach($order_packaging as $opak)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$opak->name}}</td>
                    <td>{{$opak->pack_qty.':'.$opak->prod_qty}}</td>
                    @if(\Auth::user()->role == 'owner')
                    <td>{{number_format($opak->cost)}}</td>
                    @endif
                    <td>{{number_format($opak->amount)}}</td>
                    @if(\Auth::user()->role == 'owner')
                    <td align="center">{{$opak->cost_pcs}}</td>
                    @endif
                    <td align="center"><b>{{$opak->amount_pcs}}</b></td>
                    <td align="center">
                        <a href="{{route('delete-order-detail', array($opak->id, 'packaging'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-packaging-modal"><i class="fa fa-plus"></i> Add</button>
    </div>
    <!-- /.box-body -->
</div>

<!--MODAL PACKAGING-->
<div class="modal fade" id="add-packaging-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Packaging</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'packaging')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" id="pack_name" placeholder="Packaging Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Quantity</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="number" name="pack_qty" class="form-control" id="pack_qty" placeholder="Qty" required>
                                    <span class="input-group-addon">PCS</span>
                                    </div>
                                </div>
                                <label class="col-sm-1 control-label">For</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                    <input type="number" name="prod_qty" class="form-control" id="prod_qty" placeholder="Prod Qty" required>
                                    <span class="input-group-addon">PROD</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cost</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost" class="form-control money" id="pack_cost" placeholder="Packaging Cost" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Amount(Buffer)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" class="form-control money" id="pack_amount" placeholder="Packaging Amount" required>
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