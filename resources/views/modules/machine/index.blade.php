@extends('main-layout')

@section('content')
      
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Machines Table</h3>

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
            <table class="table table-hover" id="machine-table">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Clamping Force</th>
                    <th>Depreciation</th>
                    <th>Purchase Year</th>             
                    <th>Production Year</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-machine')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@endsection

@section('custom_js')
<script>
    $('#machine-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("getMachineTable")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'brand', name: 'brand'},
            {data: 'price', name: 'price'},
            {data: 'clamping_force', name: 'clamping_force'},
            {data: 'depreciation', name: 'depreciation'},
            {data: 'purchase_year', name: 'purchase_year'},
            {data: 'production_year', name: 'production_year'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'Action', orderable: false, searchable: false}
        ]
    });
</script>
@endsection