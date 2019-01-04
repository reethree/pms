@extends('main-layout')

@section('content')
      
    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Mould Table</h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
                <th>#</th>
                <th align='center' style="text-align: center;">Name</th>
                <th align='center' style="text-align: center;">No of Cavity</th>
                <th align='center' style="text-align: center;">Price</th>
                <th align='center' style="text-align: center;">Lifetime</th>
                <th align='center' style="text-align: center;">Depreciation</th>
                <th align='center' style="text-align: center;">Status</th>
                <th align='center' style="text-align: center;">Action</th>
            </tr>
            <?php $i = 1;?>
            @foreach($moulds as $mould)
                <tr>
                  <td align='center'>{{$mould->id}}</td>
                  <td align='center'>{{$mould->name}}</td>
                  <td align='center'>{{$mould->no_of_cavity}}</td>
                  <td align='center'>{{number_format($mould->price)}}</td>
                  <td align='center'>{{$mould->lifetime}}</td>
                  <td align='center'>@if($mould->depreciation) {{'Yes'}} @else {{'No'}} @endif</td>             
                  <td align='center'>@if($mould->status == 'active')<span class="label label-success">Active</span>@else<span class="label label-danger">{{$mould->status}}</span>@endif</td>  
                  <td align='center'>
                      <a href="{{route('edit-mould', $mould->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="{{route('delete-mould', $mould->id)}}" onclick="if(!confirm('Are you sure want to delete?')){return false;}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php $i++;?>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-mould')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
            {{ $moulds->links() }}
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@endsection

@section('custom_js')

@endsection