@extends('main-layout')

@section('content')
      
<div class="row">
    <div class="col-md-12">
        <!-- LINE CHART -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Elctricity Chart</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="revenue-chart" style="height: 300px;"></div>
            </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Elctricity Table</h3>

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
                <th style="text-align: center;">Monthly Bill</th>
                <th style="text-align: center;">Historical date</th>
                <th style="text-align: center;">Action</th>
            </tr>
            <?php $i = 1;$price_history = array();?>
            @foreach($electricities as $electricity)
                <tr>
                  <td>{{$electricity->id}}</td>
                  <td align='center'>{{number_format($electricity->monthly_bill)}}</td>  
                  <td align='center'>{{date('F Y',strtotime($electricity->year.'-'.$electricity->month.'-01'))}}</td>
                  <td align='center'>
                      <a href="{{route('edit-electricity', $electricity->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="{{route('delete-electricity', $electricity->id)}}" onclick="if(!confirm('Are you sure want to delete?')){return false;}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                  </td>
                </tr>
                <?php $i++;$price_history[]=$electricity->monthly_bill;?>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="{{route('create-electricity')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
            {{ $electricities->links() }}
        </div>
      </div>
      <!-- /.box -->
    </div>
</div>
    
@endsection

@section('custom_css')

<!-- Morris charts -->
<link rel="stylesheet" href="{{ asset("bower_components/morris.js/morris.css") }}">

@endsection

@section('custom_js')
<!-- Morris.js charts -->
<script src="{{ asset("bower_components/raphael/raphael.min.js") }}"></script>
<script src="{{ asset("bower_components/morris.js/morris.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset("bower_components/fastclick/lib/fastclick.js") }}"></script>
    
<script>
$(function () {
    
    var min_price = '@if(count($price_history)>0){{ min($price_history) }}@else{{ 0 }}@endif';
    var max_price = '@if(count($price_history)>0){{ max($price_history) }}@else{{ 0 }}@endif';
    
    "use strict";
    var data = '{{ $chart }}';
    console.log(JSON.parse(data.replace(/&quot;/g,'"')));
    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: JSON.parse(data.replace(/&quot;/g,'"')),
      xkey: 'y',
      ykeys: ['bill'],
      labels: ['Bill'],
      lineColors: ['#a0d0e0'],
      hideHover: 'auto',
        xLabels: 'month',
        ymin: parseInt(min_price)-1,
        ymax: parseInt(max_price)+1
    });
});
</script>
@endsection