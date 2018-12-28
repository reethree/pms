@extends('main-layout')

@section('content')
<!-- /.row -->
<div class="row">
  <div class="col-xs-6">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Currency Table</h3>

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
            <th>Name</th>
            <th>Rate (IDR)</th>
            <th>Action</th>
          </tr>
          <?php $i = 1;?>
          @foreach($currencies as $currency)
              <tr>
                <td>{{$currency->id}}</td>
                <td>{{$currency->name}}</td>
                <td>{{number_format($currency->rate)}}</td>
                <td>
                    <button class="btn btn-info btn-xs edit-currency-btn" data-price="{{$currency->rate}}" data-id="{{$currency->id}}"><i class="fa fa-pencil"></i> Edit</button>
                </td>
              </tr>
              <?php $i++;?>
          @endforeach
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
          {{ $currencies->links() }}
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
    
<div class="modal fade" id="edit-currency-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Material</h4>
            </div>
            <form class="form-horizontal" action="{{ route('update-currency') }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">  
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <input name="id" type="hidden" id="currency_id">
                            <div class="form-group">
                                <label for="cost" class="col-sm-3 control-label">Price</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <span class="input-group-addon">IDR</span>
                                    <input type="text" name="rate" class="form-control" id="rate" required>
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

@section('custom_js')

<script>
    $(".edit-currency-btn").on("click", function(){
        var id = $(this).data('id');
        var price = $(this).data('price');
        
        $('#currency_id').val(id);
        $('#rate').val(price);
        
        $('#edit-currency-modal').modal('show');
    });
</script>

@endsection