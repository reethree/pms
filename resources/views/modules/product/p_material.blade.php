<div class="col-sm-12">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Material</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">  
            <div class="row">
                <div class="col-md-6"> 
                    <form class="form-horizontal" action="{{route('load-material-group', $product->id)}}" method="POST">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Material Group</label>
                            <div class="col-sm-6">
                                <select class="form-control" id='group_id' name="group_id" style="width: 100%;">
                                    <option value="">Choose Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-warning" id="load-group-btn">Load</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Type</th>
                      <th>Cost /Kg</th>
                      <th>Price /Kg</th>
                      <th>Qty (Kg)</th>
                      <th>Amount (Cost)</th>
                      <th>Amount (Buffer)</th>
                      <th></th>
                    </tr>
                    <?php $i = 1;$total_material = 0;$total_cost = 0;$total_qty = 0;$material_ids = array();?>
                    @foreach($product_materials as $product_material)
                    <?php
                        if($product_material->packing == 'Kg'){
                            $m_qty = $product_material->qty;
                        }else{
                            $m_qty = $product_material->qty/1000;
                        }
                        $m_amount = $product_material->price*$m_qty;
                        $c_amount = $product_material->cost*$m_qty;
                    ?>
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$product_material->material_name}}</td>  
                      <td>{{$product_material->material_type}}</td>  
                      <td>{{number_format($product_material->cost)}}</td>
                      <td>{{number_format($product_material->price)}}</td>
                      <td>{{$m_qty}}</td>
                      <td>{{number_format($c_amount)}}</td>
                      <td>{{number_format($m_amount)}}</td>
                      <td align="center">
                          <button type="button" class="btn btn-info btn-xs edit-material-btn" data-id="{{$product_material->id}}" data-cost="{{$product_material->cost}}" data-qty="{{$m_qty}}"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
                          <a href="{{route('delete-product-detail', array($product_material->id, 'material'))}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $i++;$total_material += $m_amount;$total_cost += $c_amount;$total_qty += $m_qty;$material_ids[] = $product_material->material_id;?>
                    @endforeach
                    <tr>
                        <td colspan="5">Total</td>
                        <td><b>{{$total_qty}}</b></td>
                        <td><b>{{number_format($total_cost)}}</b></td>
                        <td colspan="2"><b>{{number_format($total_material)}}</b></td>
                    </tr>
                </tbody>
            </table>
            @if($total_qty > 0 && $total_material > 0)
            <h4>Price per KG (Cost): <b>{{ 'IDR '.number_format($total_cost/$total_qty) }}</b></h4>
            <h4>Price per KG (Buffer): <b>{{ 'IDR '.number_format($total_material/$total_qty) }}</b></h4>
            @endif
        </div>
        <div class="box-footer">
            <button type="button" id="save-group-material" data-id="{{implode(',',$material_ids)}}" data-groupid="{{$product->material_group_id}}" class="btn btn-default btn-sm"><i class="fa fa-save"></i> Save Group</button>
            <button type="button" class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#add-material-modal"><i class="fa fa-plus"></i> Add</button>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<!--MODAL MATERIAL-->
<div class="modal fade" id="add-material-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Material</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-product-detail', array($product->id,'material')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Material</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id='material_id' name="material_id" style="width: 100%;">
                                        <option value="">Choose Material</option>
                                        @foreach($materials as $material)
                                            <option value="{{$material->id}}" data-cost="{{$material->price_last}}" data-type="{{$material->type}}" data-curr="{{$material->currency}}">{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="material_price" class="col-sm-3 control-label">Price</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="currency">IDR</span>
                                    <input type="text" class="form-control" id="material_price" placeholder="Material Price" required readonly>
                                    <span class="input-group-addon">per KG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usd_rate" class="col-sm-3 control-label">1 USD Rate</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" class="form-control" id="usd_rate" value="{{$rate}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cost" class="col-sm-3 control-label">Amount (Cost)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost" class="form-control" id="material_cost" required readonly>
                                    <span class="input-group-addon">per KG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="buffer" class="col-sm-3 control-label">Amount (Buffer)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="price" id="material_buffer" class="form-control" placeholder="Material Price" required>
                                    <span class="input-group-addon">per KG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="material_qty" class="col-sm-3 control-label">Quantity</label>
                                <div class="col-sm-4">
                                    <input type="text" name="qty" class="form-control" id="material_qty" placeholder="Material Quantity" required>                                       
                                </div>
                                <div class="col-sm-2" style="padding-left: 0;">
                                    <select class="form-control" name="packing" style="width: 100%;">
                                        <option value="Kg" selected="selected">Kg</option>
                                        <option value="Gram">Gram</option>
                                    </select>
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

<div class="modal fade" id="edit-material-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Material</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-product-detail', array($product->id,'material')) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">  
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input name="product_material_id" type="hidden" id="product_material_id">
                            <div class="form-group">
                                <label for="cost" class="col-sm-3 control-label">Amount (Cost)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="cost" class="form-control" id="material_cost_edit" required readonly>
                                    <span class="input-group-addon">per KG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="buffer" class="col-sm-3 control-label">Amount (Buffer)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="price" id="material_buffer" class="form-control" placeholder="Material Price" required>
                                    <span class="input-group-addon">per KG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="material_qty" class="col-sm-3 control-label">Quantity</label>
                                <div class="col-sm-4">
                                    <input type="text" name="qty" class="form-control" id="material_qty_edit" placeholder="Material Quantity" required>                                       
                                </div>
                                <div class="col-sm-2" style="padding-left: 0;">
                                    <select class="form-control" name="packing" style="width: 100%;">
                                        <option value="Kg" selected="selected">Kg</option>
                                        <option value="Gram">Gram</option>
                                    </select>
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

<div class="modal fade" id="save-group-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Save Material to Group</h4>
            </div>

            <form class="form-horizontal" action="{{ route("saveGroupMaterial", $product->id) }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">  
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <h5 style="text-align: center;color: red;padding-bottom: 20px;font-weight: bold;">Please choose material group for update group or input group name for new group.</h5>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Material Group</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id='save_group_id' name="group_id" style="width: 100%;">
                                        <option value="">Choose Group</option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">New Group Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="new_group_name" class="form-control">
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