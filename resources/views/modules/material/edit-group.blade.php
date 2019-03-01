@extends('main-layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Form Material Group</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" action="{{ route('store-material-group') }}" enctype="multipart/form-data" method="POST">
                <div class="box-body">            
                    <div class="row">
                        <div class="col-md-12">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <div class="form-group">
                              <label for="name" class="col-sm-3 control-label">Group Name</label>
                              <div class="col-sm-8">
                                  <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$group->name}}" required>
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option value="active" @if($group->status == 'active') selected @endif>Active</option>
                                        <option value="inactive" @if($group->status == 'inactive') selected @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Save</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Materials</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th style="text-align: center;">Type</th>
                  <th style="text-align: center;">Weight(Kg)</th>
                  <th style="text-align: center;">Cost(IDR)</th>
                  <th style="text-align: center;">Buffer(IDR)</th>
                  <!--<th style="text-align: center;">Status</th>-->
                  <th></th>
                </tr>
                <?php $i=1;?>
                @foreach($material_group as $mg)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$mg->name}}</td>
                  <td align='center'>{{$mg->type}}</td>
                  <td>{{$mg->weight}}</td>
                  <td>{{number_format($mg->cost)}}</td>
                  <td>{{number_format($mg->price)}}</td>
                  <!--<td align='center'>@if($mg->status == 'active')<span class="label label-success">Active</span>@else<span class="label label-danger">{{$mg->status}}</span>@endif</td>-->
                    <td align='center'>
                        <a href="{{route('delete-material-group-detail', $mg->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
              </tbody>
              </table>
                <h4>Price per KG (Cost): <b>{{ 'IDR '.number_format($group->price) }}</b></h4>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#add-material-modal"><i class="fa fa-plus"></i> Add</button>
                {{ $material_group->links() }}
            </div>
          </div>
    </div>
</div>      

<div class="modal fade" id="add-material-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Material</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-material-group-detail', $group->id) }}" enctype="multipart/form-data" method="POST">
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
                                            <option value="{{$material->id}}" data-cost="{{$material->price}}" data-type="{{$material->type}}" data-curr="{{$material->currency}}">{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Weight</label>
                                <div class="col-sm-6">
                                    <div class="input-group">                           
                                        <input type="text" name="weight" class="form-control" id="material_weight" placeholder="Material Weight" required>            
                                        <span class="input-group-addon">Kg</span>
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

@endsection

@section('custom_css')


@endsection

@section('custom_js')


@endsection