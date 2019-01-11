@extends('main-layout')

@section('content')
      
    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Products Table</h3>

          <div class="box-tools">
<!--            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>-->
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover" id="product-table">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Name</th>
                    <th>Monthly Qty</th>
                    <th>Weight (Prediction)</th>
                    <th>Weight (Buffer)</th>
                    <th>Efficiency (Actual)</th>
                    <th>Efficiency (Buffer)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-product')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@endsection

@section('custom_js')
<script>
    $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("getProductTable")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'customer_name', name: 'customer_name', searchable: false},
            {data: 'name', name: 'name'},
            {data: 'monthly_qty', name: 'monthly_qty'},
            {data: 'weight_pre', name: 'weight_pre'},
            {data: 'weight_buff', name: 'weight_buff'},
            {data: 'efficiency_actual', name: 'efficiency_actual'},
            {data: 'efficiency_buffer', name: 'efficiency_buffer'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'Action', orderable: false, searchable: false}
        ]
    });
</script>
@endsection