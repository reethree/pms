@extends('main-layout')

@section('content')
      
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orders Preview</h3>
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-sm-6">
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th align='center' style="text-align: center;">Name</th>
                        <th align='center' style="text-align: center;">Material Cost</th>
                        <th align='center' style="text-align: center;">Material Buffer</th>
                    </tr>
                    <?php $i = 1;?>
                    @foreach($order_product as $o_prod)
                        <tr>
                          <td align='center'>{{$i}}</td>
                          <td align='center'>{{$o_prod->product_name}}</td>
                          <td align='center'>{{$o_prod->material_cost}}</td>  
                          <td align='center'>{{$o_prod->material_buffer}}</td> 
                        </tr>
                        <?php $i++;?>
                    @endforeach
                  </table>
                </div>
            </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
</div>
    
@endsection

@section('custom_js')

@endsection