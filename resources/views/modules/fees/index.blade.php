@extends('main-layout')

@section('content')
      
    <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Management Fees Table</h3>

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
                <th align='center' style="text-align: center;">Monthly Update</th>
                <th align='center' style="text-align: center;">Historical Date</th>
                <th align='center' style="text-align: center;">Action</th>
            </tr>
            <?php $i = 1;?>
            @foreach($fees as $fee)
                <tr>
                  <td align='center'>{{$fee->id}}</td>
                  <td align='center'>{{number_format($fee->monthly_revenue)}}</td>
                  <td align='center'>{{date('F Y',strtotime($fee->year.'-'.$fee->month.'-01'))}}</td> 
                  <td align='center'>
                      <a href="{{route('edit-fees', $fee->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="{{route('delete-fees', $fee->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php $i++;?>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-fees')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
            {{ $fees->links() }}
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
    
@endsection

@section('custom_js')

@endsection