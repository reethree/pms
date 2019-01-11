@extends('main-layout')

@section('content')  

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Customer Table</h3>

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
                <table class="table table-hover" id="customer-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="{{route('create-customer')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
    
@endsection

@section('custom_js')
<script>
    $('#customer-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("getCustomerTable")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'Action', orderable: false, searchable: false}
        ]
    });
</script>
@endsection