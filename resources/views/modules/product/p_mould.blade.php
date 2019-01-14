<div class="col-sm-6" style="padding-right: 5px;">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Mould</h3>

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
                      <th>Cavity</th>
                      <th>Depr (Month)</th>
                      <th>Cost</th>
                      <th>Amount (Buffer)</th>
                      <th></th>
                    </tr>
                    <?php $i = 1;$total_mould = 0;?>
                    @foreach($product_moulds as $product_mould)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$product_mould->mould_name}}</td>
                      <td align="center">{{$product_mould->cavity}}</td>
                      <td align="center">{{$product_mould->mould_depr}}</td>
                      <td>{{number_format($product_mould->mould_cost)}}</td>
                      <td>{{number_format($product_mould->mould_buff)}}</td>
                      <td>
                          <a href="{{route('delete-product-detail', array($product_mould->id, 'mould'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php $total_mould += $product_mould->mould_buff;$i++;?>
                    @endforeach
                    <tr>
                        <td colspan="5">Total Amount</td>
                        <td colspan="2"><b>{{number_format($total_mould)}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-mould-modal"><i class="fa fa-plus"></i> Add</button>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<!--MODAL MOULD-->
<div class="modal fade" id="add-mould-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Mould</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-product-detail', array($product->id,'mould')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mould</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id='mould_id' name="mould_id" style="width: 100%;">
                                        <option value="">Choose Mould</option>
                                        @foreach($moulds as $mould)
                                            <option value="{{$mould->id}}" data-cost="{{number_format($mould->price)}}">{{$mould->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mould_cost" class="col-sm-3 control-label">Cost</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="mould_cost" class="form-control" id="mould_cost" placeholder="Mould Cost" required  readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mould_buff" class="col-sm-3 control-label">Buffer</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="number" name="mould_buff" class="form-control" id="mould_buff" placeholder="Amount" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mould_depr" class="col-sm-3 control-label">Depr. Period</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    
                                    <input type="number" name="mould_depr" class="form-control" id="mould_depr" required>
                                    <span class="input-group-addon">Month</span>
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