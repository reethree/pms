<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Transport</h3>

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
                  <th>Cost Total</th>
                  <th>Amount Total</th>
                  @if(\Auth::user()->role == 'owner')
                  <th>Cost<br />per PCS</th>
                  @endif
                  <th>Amount (Buffer)<br />per PCS</th>
                  <th></th>
                </tr>
                <?php $i = 1;?>
                @foreach($order_transport as $ot)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{number_format($ot->cost)}}</td>
                    <td>{{number_format($ot->amount)}}</td>
                    @if(\Auth::user()->role == 'owner')
                    <td align="center">{{$ot->cost_pcs}}</td>
                    @endif
                    <td align="center"><b>{{$ot->amount_pcs}}</b></td>
                    <td align="center">
                        <button type="button" class="btn btn-info btn-xs edit-trans-btn" data-id="{{$ot->id}}" data-cost="{{$ot->cost}}" data-buffer="{{$ot->amount}}"><i class="fa fa-edit"></i></button>
                        <a href="{{route('delete-order-detail', array($ot->id, 'transport'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-transport-modal"><i class="fa fa-plus"></i> Add</button>
    </div>
    <!-- /.box-body -->
</div>

<!--MODAL TRANSPORT-->
<div class="modal fade" id="add-transport-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Transport</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'transport')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cost total</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost" class="form-control money" placeholder="Cost Total Transport" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Buffer total</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" class="form-control money" placeholder="Amount Total Transport" required>
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

<div class="modal fade" id="edit-transport-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Transport</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'transport')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input name="id" type="hidden" id="edit_trans_id">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cost total</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost" id="edit_trans_cost" class="form-control money" placeholder="Cost Total Transport" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Buffer total</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" id="edit_trans_amount" class="form-control money" placeholder="Amount Total Transport" required>
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