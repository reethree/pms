@extends('main-layout')

@section('content')
<?php $overhead = 0;$overhead_price = 0;$profile = 0;$profile_price = 0;?>

<section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
<!--          <i class="fa fa-globe"></i> AdminLTE, Inc.-->
          Pricing Calculation  
          <small class="pull-right">Date: {{date('d F Y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
          <div class="row">
            <form class="form-horizontal" action="{{route('updateDetailCalculation', $calc->id)}}" enctype="multipart/form-data" method="POST">
                <div class="col-md-6">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Customer</label>
                        <div class="col-sm-8">
                            <select class="form-control" id='customer_id' name="customer_id" style="width: 100%;">
                                <option value="">Choose Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" @if($customer->id == $calc->customer_id) {{'selected'}} @endif>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Product</label>
                        <div class="col-sm-8">
                            <select class="form-control" id='product_id' name="product_id" style="width: 100%;">
                                <option value="">Choose Product</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}" @if($product->id == $calc->product_id) {{'selected'}} @endif>{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Mould</label>
                      <div class="col-sm-8">
                          <select class="form-control" id='mould_id' name="mould_id" style="width: 100%;">
                              <option value="">Choose Mould</option>
                              @foreach($moulds as $mould)
                                  <option value="{{$mould->id}}" @if($mould->id == $calc->mould_id) {{'selected'}} @endif>{{$mould->name}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>   
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Machine</label>
                      <div class="col-sm-8">
                          <select class="form-control" id='machine_id' name="machine_id" style="width: 100%;">
                              <option value="">Choose Machine</option>
                              @foreach($machines as $machine)
                                  <option value="{{$machine->id}}" @if($machine->id == $calc->machine_id) {{'selected'}} @endif>{{$machine->name}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Material</label>
                      <div class="col-sm-8">
                          <select class="form-control" id='mould_id' name="material_id" style="width: 100%;">
                              <option value="">Choose Material</option>
                              @foreach($materials as $material)
                                  <option value="{{$material->id}}" @if($material->id == $calc->material_id) {{'selected'}} @endif>{{$material->name}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Masterbatch</label>
                      <div class="col-sm-8">
                          <select class="form-control" id='machine_id' name="masterbatch_id" style="width: 100%;">
                              <option value="">Choose Masterbatch</option>
                              @foreach($materials as $material)
                                  <option value="{{$material->id}}" @if($material->id == $calc->masterbatch_id) {{'selected'}} @endif>{{$material->name}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
            </form>
          </div>
          <hr />
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Product Info</th>
            <th>Monthly Qty</th>
            @if(\Auth::user()->role == 'owner')
            <th>Material Cost</th>
            <th>Mould Cost</th>
            <th>Machine Cost</th>
            @endif
            <th>Material Buffer</th>
            <th>Mould Buffer</th>
            <th>Machine Buffer</th>
          </tr>
          </thead>
          <tbody>
                <?php 
                    $p_total_cost = $results['material']['actual'] + $results['mould']['actual'] + $results['machine']['actual'];
                    $p_total_price = $results['material']['buffer'] + $results['mould']['buffer'] + $results['machine']['buffer'];
                ?>
                <tr>
                  <td>1</td>
                  <td>
                      @if($results['product'])
                        <b>{{'Customer : '.$results['customer']->name}}</b><br /><br />
                        <img src="{{ asset("uploads/product/".$results['product']->photo)}}" width="120" />
                        <br />
                        Name : {{$results['product']->name}}<br />
                        Weight : {{$calc->weight_buffer}}<br />
                        Material Efficiency : {{$calc->material_efficiency.'%'}}<br /><br />
                        Cavity : {{$calc->cavity}}<br />
                        Cycle Time : {{$calc->cycle_time}}<br />
                        Time Efficiency : {{$calc->time_efficiency.'%'}}<br />
                        Production Needed : {{$calc->days_needed_buffer.' days'}}
                      @else
                        Name : {{$calc->name}}<br />
                        Weight : {{$calc->weight_buff}}<br />
                        Material Efficiency : {{$calc->material_efficiency.'%'}}<br /><br />
                        Cavity : {{$calc->cavity}}<br />
                        Cycle Time : {{$calc->cycle_time}}<br />
                        Time Efficiency : {{$calc->time_efficiency.'%'}}<br />
                        Production Needed : {{$calc->days_needed_buffer.' days'}}
                      @endif
                  </td>
                  <td style="vertical-align: middle;">{{number_format($calc->quantity)}}</td>
                  @if(\Auth::user()->role == 'owner')
                  <td style="vertical-align: middle;text-align: center;">{{number_format($results['material']['actual'], 1)}}</td>  
                  <td style="vertical-align: middle;text-align: center;">{{number_format($results['mould']['actual'], 1)}}</td> 
                  <td style="vertical-align: middle;text-align: center;">{{number_format($results['machine']['actual'], 1)}}</td> 
                  @endif
                  <td style="vertical-align: middle;text-align: center;">{{number_format($results['material']['buffer'], 1)}}</td> 
                  <td style="vertical-align: middle;text-align: center;">{{number_format($results['mould']['buffer'], 1)}}</td>
                  <td style="vertical-align: middle;text-align: center;">{{number_format($results['machine']['buffer'], 1)}}</td>
                </tr>

                <tr>
                    @if(\Auth::user()->role == 'owner')
                    <td colspan="2" align="right"><b>TOTAL ACTUAL</b></td>
                    <td colspan="2"><b>{{number_format($p_total_cost, 1)}}</b></td>
                    <td colspan="2" align="right"><b>TOTAL BUFFER</b></td>
                    <td colspan="2"><b>{{number_format($p_total_price, 1)}}</b></td>
                    @else
                    <td colspan="5" align="center"><b>TOTAL BUFFER</b></td>
                    <td colspan="2"><b>{{number_format($p_total_price, 1)}}</b></td>
                    @endif

                </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            @if(\Auth::user()->role == 'owner')
            <th>Cost</th>
            @endif
            <th>Price</th>
          </tr>
          </thead>
          <tbody>
            <?php $total_cost = 0;$total_price = 0;?>
            <tr>
              <td>1</td>
              <td>Labour ({{$calc->days_needed_buffer}} days)</td>
              @if(\Auth::user()->role == 'owner')
              <td>{{number_format($results['labour']['actual'],1)}}</td>  
              @endif
              <td>{{number_format($results['labour']['buffer'],1)}}</td> 
            </tr>
            <?php $total_cost+=$results['labour']['actual'];$total_price+=$results['labour']['buffer'];?>

            <tr>
              <td>2</td>
              <td>Electricity ({{$calc->days_needed_buffer}} days)</td>
              @if(\Auth::user()->role == 'owner')
              <td>{{number_format($results['elec']['actual'],1)}}</td>  
              @endif
              <td>{{number_format($results['elec']['buffer'],1)}}</td> 
            </tr>
            <?php $total_cost+=$results['elec']['actual'];$total_price+=$results['elec']['buffer'];?>

            <tr>
              <td>3</td>
              <td>Packaging 1</td>
              @if(\Auth::user()->role == 'owner')
              <td>{{number_format($results['packing1']['actual'],1)}}</td>  
              @endif
              <td>{{number_format($results['packing1']['buffer'],1)}}</td> 
            </tr>
            <?php $total_cost+=$results['packing1']['actual'];$total_price+=$results['packing1']['buffer'];?>
            
            <tr>
              <td>4</td>
              <td>Packaging 2</td>
              @if(\Auth::user()->role == 'owner')
              <td>{{number_format($results['packing2']['actual'],1)}}</td>  
              @endif
              <td>{{number_format($results['packing2']['buffer'],1)}}</td> 
            </tr>
            <?php $total_cost+=$results['packing2']['actual'];$total_price+=$results['packing2']['buffer'];?>

            <tr>
              <td>5</td>
              <td>Transport</td>
              @if(\Auth::user()->role == 'owner')
              <td>{{number_format($results['transport']['actual'],1)}}</td>  
              @endif
              <td>{{number_format($results['transport']['buffer'],1)}}</td> 
            </tr>
            <?php $total_cost+=$results['transport']['actual'];$total_price+=$results['transport']['buffer'];?>

            <tr>
                <td colspan="2" align="center"><b>TOTAL PRICE</b></td>
                @if(\Auth::user()->role == 'owner')
                <td><b>{{number_format($total_cost,1)}}</b></td>
                @endif
                <td><b>{{number_format($total_price,1)}}</b></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <div class="row">
       @if(\Auth::user()->role == 'owner')
       <?php 
        $subtot_cogs = $p_total_cost+$total_cost;
        $overhead_cogs = $subtot_cogs*($calc->overhead/100);
        $total_cogs = $subtot_cogs+$overhead_cogs;
       ?>
      <div class="col-xs-6">
        <p class="lead">COGS</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal Per PCS:</th>
              <td><b>IDR {{ number_format($subtot_cogs,1) }}</b></td>
            </tr>
            <tr>
                <th style="width:50%">Overhead Per PCS:</th>
                <td><b>IDR {{ number_format($overhead_cogs,1) }}</b></td>
            </tr>
            <tr>
                <td colspan="2">--------------------------------------------------</td>
            </tr>
            <tr style="font-size: 18px;">
              <th>Total per PCS:</th>
              <td><b>IDR {{number_format($total_cogs,1)}}</b></td>
            </tr>
            <tr>
              <th>Monthly:</th>
              <td><b>IDR {{number_format($total_cogs*$calc->quantity)}}</b></td>
            </tr>
            <tr>
              <th>Yearly:</th>
              <td><b>IDR {{number_format($total_cogs*($calc->quantity*12))}}</b></td>
            </tr>
          </table>
        </div>
      </div>
        @endif
        <?php 
        $subtot_sell = $p_total_price+$total_price;
        $overhead_sell = $subtot_sell*($calc->overhead/100);
        $profit_sell = ($subtot_sell+$overhead_sell)*($calc->profit/100);
        $total_sell = $subtot_sell+$overhead_sell+$profit_sell;
        ?>
        <div class="col-xs-6">
        <p class="lead">SELLING PRICE</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal Per PCS:</th>
              <td><b>IDR {{ number_format($subtot_sell,1) }}</b></td>
            </tr>
            <tr>
                <th style="width:50%">Overhead Per PCS:</th>
                <td><b>IDR {{ number_format($overhead_sell,1) }}</b></td>
            </tr>
            <tr>
                <th style="width:50%">Profit Per PCS:</th>
                <td><b>IDR {{ number_format($profit_sell,1) }}</b></td>
            </tr>
            <tr>
                <td colspan="2">--------------------------------------------------</td>
            </tr>
            <tr style="font-size: 18px;">
              <th>Total per PCS:</th>
              <td><b>IDR {{number_format($total_sell,1)}}</b></td>
            </tr>
            <tr>
              <th>Monthly:</th>
              <td><b>IDR {{number_format($total_sell*$calc->quantity)}}</b></td>
            </tr>
            <tr>
              <th>Yearly:</th>
              <td><b>IDR {{number_format($total_sell*($calc->quantity*12))}}</b></td>
            </tr>
          </table>
        </div>
      </div>
        
    </div>
    <!-- /.row -->
    @if(\Auth::user()->role == 'owner')
    <div style="clear: both;"></div>
    <div class="row" style="display:block;">
        <hr />
        <div class="col-xs-6" style="width: 48%;">
            <p class="lead"><b>NET MARGIN</b></p>
            <?php
                $profit_pcs = $total_sell-$total_cogs;
                $profit_margin = ($profit_pcs/$total_sell)*100;
            ?>
        <div class="table-responsive">
          <table class="table">
            <tr style="font-size: 18px;">
              <td>Net Margin per PCS:</td>
              <td style="text-align: right;"><b>{{number_format($profit_pcs,2)}}</b></td>
            </tr>
            <tr>
              <td>Margin:</td>
              <td style="text-align: right;"><b>{{number_format($profit_margin,2).'%'}}</b></td>
            </tr>
            <tr>
              <td>Monthly:</td>
              <td style="text-align: right;"><b>{{number_format($profit_pcs*$calc->quantity)}}</b></td>
            </tr>
            <tr>
              <td>Yearly:</td>
              <td style="text-align: right;"><b>{{number_format($profit_pcs*($calc->quantity*12))}}</b></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    @endif
    
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="{{route('download-pdf-calc', $calc->id)}}" class="btn btn-default"><i class="fa fa-print"></i> Download PDF</a>
        <!--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->
        <a href="{{route('send-email-calc', $calc->id)}}" onclick="return confirm('Are you sure ?')" class="btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-envelope"></i> SEND EMAIL
        </a>
      </div>
    </div>
    
</section>
    
@endsection

@section('custom_css')
 <!--Select2--> 
<link href="{{ asset("/bower_components/select2/dist/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('custom_js')
<!-- Select2 -->
<script src="{{ asset("/bower_components/select2/dist/js/select2.min.js") }}"></script>

<script type="text/javascript">
    $('select').select2(); 
</script>
@endsection