@extends('main-layout')

@section('content')
      
    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Products Table</h3>

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
                <th align='center' style="text-align: center;">Customer</th>
                <th align='center' style="text-align: center;">Name</th>
                <th align='center' style="text-align: center;">Monthly Qty</th>
                <th align='center' style="text-align: center;">Weight (Prediction)</th>
                <th align='center' style="text-align: center;">Weight (Buffer)</th>
                <th align='center' style="text-align: center;">Efficiency (Actual)</th>
                <th align='center' style="text-align: center;">Efficiency (Buffer)</th>
                <th align='center' style="text-align: center;">Status</th>
                <th align='center' style="text-align: center;">Action</th>
            </tr>
            <?php $i = 1;?>
            @foreach($products as $product)
                <tr>
                  <td align='center'>{{$product->id}}</td>
                  <td align='center'>{{$product->customer_name}}</td>
                  <td align='center'>{{$product->name}}</td>
                  <td align='center'>{{$product->monthly_qty}}</td>
                  <td align='center'>{{$product->weight_pre.' Gram'}}</td>
                  <td align='center'>{{$product->weight_buff.' Gram'}}</td>
                  <td align='center'>{{$product->efficiency_actual.'%'}}</td>
                  <td align='center'>{{$product->efficiency_buffer.'%'}}</td>
                  <td align='center'>@if($product->status == 'active')<span class="label label-success">Active</span>@else<span class="label label-danger">$customer->status</span>@endif</td>  
                  <td align='center'>
                      <a href="{{route('edit-product', $product->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="{{route('delete-product', $product->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php $i++;?>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-product')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
            {{ $products->links() }}
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@endsection

@section('custom_js')

@endsection