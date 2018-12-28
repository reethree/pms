@extends('main-layout')

@section('content')
      
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Machines Table</h3>

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
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Brand</th>
                <th style="text-align: center;">Price</th>
                <th style="text-align: center;">Clamping Force</th>
                <th style="text-align: center;">Purchase Year</th>
                <th style="text-align: center;">Depreciation</th>
                <!--<th style="text-align: center;">Depreciation Finish</th>-->               
                <th style="text-align: center;">Production Year</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Action</th>
            </tr>
            <?php $i = 1;?>
            @foreach($machines as $machine)
                <tr>
                  <td>{{$machine->id}}</td>
                  <td align='center'>{{$machine->name}}</td>
                  <td align='center'>{{$machine->brand}}</td>
                  <td align='center'>{{number_format($machine->price)}}</td>
                  <td align='center'>{{$machine->clamping_force}}</td>
                  <td align='center'>{{$machine->purchase_year}}</td>
                  <td align='center'>@if($machine->depreciation)<span class="label label-success">Yes</span>@else<span class="label label-danger">No</span>@endif</td>
                  <!--<td align='center'>{{date('d F Y', strtotime($machine->depreciation_finish))}}</td>-->
                  <td align='center'>{{$machine->production_year}}</td>                
                  <td align='center'>@if($machine->status == 'active')<span class="label label-success">Active</span>@else<span class="label label-danger">{{$machine->status}}</span>@endif</td>  
                  <td align='center'>
                      <a href="{{route('edit-machine', $machine->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="{{route('delete-machine', $machine->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php $i++;?>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-machine')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
            {{ $machines->links() }}
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@endsection

@section('custom_js')

@endsection