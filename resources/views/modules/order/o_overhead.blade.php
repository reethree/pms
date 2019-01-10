<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Overhead</h3>

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
<!--                  <th>Year</th>
                  <th>Max</th>
                  <th>Min</th>
                  <th>Average</th>-->
                  <th>Amount</th>
                  <th>Profit</th>
                  <th>Overhead (Buffer)<br />per PCS</th>
                  <th></th>
                </tr>
                <?php $i = 1;?>
                @foreach($order_overhead as $oo)
                <tr>
                    <td>{{$i}}</td>
<!--                    <td>{{$oo->year}}</td>
                    <td>{{number_format($oo->max)}}</td>
                    <td>{{number_format($oo->min)}}</td>
                    <td>{{number_format($oo->avg)}}</td>-->
                    <td>{{number_format($oo->amount).'%'}}</td>
                    <td>{{number_format($oo->profit).'%'}}</td>
                    <td align="center"><b>{{number_format($oo->amount_pcs)}}</b></td>
                    <td align="center">
                        <a href="{{route('delete-order-detail', array($oo->id, 'overhead'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-overhead-modal"><i class="fa fa-plus"></i> Add</button>
    </div>
    <!-- /.box-body -->
</div>

<!--MODAL ELECTRICITY-->
<div class="modal fade" id="add-overhead-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Overhead</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'overhead')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
<!--                            <div class="form-group">
                                <label class="col-sm-3 control-label">Year</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="overhead_year" name="year" style="width: 100%;">
                                        <option value="">Choose Year</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Max Value</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="max" class="form-control" id="overhead_max" placeholder="Max Value" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Min Value</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="min" class="form-control" id="overhead_min" placeholder="Min Value" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Average</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="avg" class="form-control" id="overhead_avg" placeholder="Average Value" required readonly>
                                    </div>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label for="amount" class="col-sm-3 control-label">Overhead (%)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="number" max="100" name="amount" class="form-control" id="amount_overhead" placeholder="Amount" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="col-sm-3 control-label">Profit (%)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="number" max="100" name="profit" class="form-control" id="amount_overhead" placeholder="Amount" required>
                                        <span class="input-group-addon">%</span>
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