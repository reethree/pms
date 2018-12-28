<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Electricity</h3>

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
                  <th>Total Machine</th>
                  <th>Days Needed</th>
                  <th>Average per Month</th>
                  <th>Amount</th>
                  <th>Electricity (Buffer)<br />per PCS</th>
                  <th></th>
                </tr>
                <?php $i = 1;?>
                @foreach($order_electricity as $oe)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$oe->year}}</td>
                    <td align="center">{{number_format($oe->total_machine)}}</td>
                    <td align="center">{{number_format($oe->days_needed)}}</td>
                    <td>{{number_format($oe->avg_bill)}}</td>
                    <td>{{number_format($oe->amount)}}</td>
                    <td align="center"><b>{{number_format($oe->pcs)}}</b></td>
                    <td align="center">
                        <a href="{{route('delete-order-detail', array($oe->id, 'electricity'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-electricity-modal"><i class="fa fa-plus"></i> Add</button>
    </div>
    <!-- /.box-body -->
</div>

<!--MODAL ELECTRICITY-->
<div class="modal fade" id="add-electricity-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Electricity</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'electricity')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Year</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="electricity_year" name="year" style="width: 100%;">
                                        <option value="">Choose Year</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="max_bill" class="col-sm-3 control-label">Max per Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="max_bill" class="form-control" id="max_bill" placeholder="Max Bill per Month" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="min_bill" class="col-sm-3 control-label">Min per Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="min_bill" class="form-control" id="min_bill" placeholder="Min Bill per Month" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="avg_bill" class="col-sm-3 control-label">Avg per Month</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="avg_bill" class="form-control" id="avg_bill" placeholder="Average Bill per Month" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Total Machine</label>
                                <div class="col-sm-8">
                                    <input type="number" name="total_machine" class="form-control" placeholder="Total Machine" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Days Needed</label>
                                <div class="col-sm-8">
                                    <input type="number" name="days_needed" class="form-control" placeholder="Total Machine" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="col-sm-3 control-label">Amount (Buffer)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" class="form-control" id="amount_electricity" placeholder="Amount" required>
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