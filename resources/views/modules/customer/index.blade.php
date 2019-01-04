@extends('main-layout')

@section('content')
      
    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Customer Table</h3>

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
                <th align='center' style="text-align: center;">phone</th>
                <th align='center' style="text-align: center;">Address</th>
<!--                <th align='center' style="text-align: center;">PIC</th>
                <th align='center' style="text-align: center;">No. of Order</th>
                <th align='center' style="text-align: center;">Revenue</th>-->
                <th align='center' style="text-align: center;">Status</th>
                <th align='center' style="text-align: center;">Action</th>
            </tr>
            <?php $i = 1;?>
            @foreach($customers as $customer)
                <tr>
                  <td align='center'>{{$customer->id}}</td>
                  <td align='center'>{{$customer->name}}</td>
                  <td align='center'>{{$customer->phone}}</td>
                  <td align='center'>{{$customer->address}}</td>
<!--                  <td align='center'>{{$customer->pic}}</td>
                  <td align='center'>{{$customer->no_of_order}}</td>
                  <td align='center'>{{$customer->revenue}}</td>-->
                  <td align='center'>@if($customer->status == 'active')<span class="label label-success">Active</span>@else<span class="label label-danger">{{$customer->status}}</span>@endif</td>  
                  <td align='center'>
                      <a href="{{route('edit-customer', $customer->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="{{route('delete-customer', $customer->id)}}" onclick="if(!confirm('Are you sure want to delete?')){return false;}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php $i++;?>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-customer')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
            {{ $customers->links() }}
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@endsection

@section('custom_js')

@endsection