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
                <?php $i = 1;$p_total_cost = 0;$p_total_price = 0;$monthly_qty = 0;?>
                @foreach($order_product as $o_prod)
                    <tr>
                      <td>{{$i}}</td>
                      <td>
                            <b>{{'Customer : '.$o_prod->customer_name}}</b><br /><br />
                            <img src="{{ asset("uploads/product/".$o_prod->photo)}}" width="120" />
                            <br />
                            Name : {{$o_prod->name}}<br />
                            Weight : {{$o_prod->weight_buff}}<br />
                            Material Efficiency : {{$o_prod->efficiency_buffer.'%'}}<br /><br />
                            Cavity : {{$o_prod->cavity}}<br />
                            Cycle Time : {{$o_prod->cycle_time}}<br />
                            Time Efficiency : {{$o_prod->efficiency.'%'}}<br />
                            Production Needed : {{$o_prod->qty_prod.' days'}}
<!--                            {{'Product Name : '.$o_prod->name}}<br />
                            {{'Weight Prediction : '.$o_prod->weight_pre.' Gram'}}<br />
                            {{'Weight Buffer : '.$o_prod->weight_buff.' Gram'}}<br />
                            {{'Efficiency Actual : '.$o_prod->efficiency_actual.'%'}}<br />
                            {{'Efficiency Buffer : '.$o_prod->efficiency_buffer.'%'}}-->
                      </td>
                      <td style="vertical-align: middle;">{{number_format($o_prod->quantity)}}</td>
                      @if(\Auth::user()->role == 'owner')
                      <td style="vertical-align: middle;text-align: center;">{{$o_prod->material_cost}}</td>  
                      <td style="vertical-align: middle;text-align: center;">{{$o_prod->mould_cost}}</td> 
                      <td style="vertical-align: middle;text-align: center;">{{$o_prod->machine_cost}}</td> 
                      @endif
                      <td style="vertical-align: middle;text-align: center;">{{$o_prod->material_buffer}}</td> 
                      <td style="vertical-align: middle;text-align: center;">{{$o_prod->mould_buffer}}</td>
                      <td style="vertical-align: middle;text-align: center;">{{$o_prod->machine_buffer}}</td>
                    </tr>
                    <?php $i++;
                        $p_total_cost+=$o_prod->material_cost+$o_prod->mould_cost+$o_prod->machine_cost;
                        $p_total_price+=$o_prod->material_buffer+$o_prod->mould_buffer+$o_prod->machine_buffer;
                        $monthly_qty+=$o_prod->quantity;
                    ?>
                @endforeach
                <tr>
                    @if(\Auth::user()->role == 'owner')
                    <td colspan="2" align="right"><b>TOTAL COST</b></td>
                    <td colspan="2"><b>{{$p_total_cost}}</b></td>
                    <td colspan="2" align="right"><b>TOTAL PRICE</b></td>
                    <td colspan="2"><b>{{$p_total_price}}</b></td>
                    @else
                    <td colspan="5" align="center"><b>TOTAL PRICE</b></td>
                    <td colspan="2"><b>{{$p_total_price}}</b></td>
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
            <?php $i = 1;$total_cost = 0;$total_price = 0;?>
            @foreach($order_labour as $o_lab)
                <tr>
                  <td>{{$i}}</td>
                  <td>Labour ({{$o_lab->qty}} days)</td>
                  @if(\Auth::user()->role == 'owner')
                  <td>{{$o_lab->labour_cost}}</td>  
                  @endif
                  <td>{{$o_lab->labour_pcs}}</td> 
                </tr>
                <?php $i++;$total_cost+=$o_lab->labour_cost;$total_price+=$o_lab->labour_pcs;?>
            @endforeach
            @foreach($order_electricity as $o_ele)
                <tr>
                  <td>{{$i}}</td>
                  <td>Electricity ({{$o_ele->days_needed}} days)</td>
                  @if(\Auth::user()->role == 'owner')
                  <td>{{$o_ele->pcs_cost}}</td>  
                  @endif
                  <td>{{$o_ele->pcs}}</td> 
                </tr>
                <?php $i++;$total_cost+=$o_ele->pcs_cost;$total_price+=$o_ele->pcs;?>
            @endforeach
            @foreach($order_packaging as $o_pack)
                <tr>
                  <td>{{$i}}</td>
                  <td>Packaging ({{$o_pack->name}})</td>
                  @if(\Auth::user()->role == 'owner')
                  <td>{{$o_pack->cost_pcs}}</td>  
                  @endif
                  <td>{{$o_pack->amount_pcs}}</td> 
                </tr>
                <?php $i++;$total_cost+=$o_pack->cost_pcs;$total_price+=$o_pack->amount_pcs;?>
            @endforeach
            @foreach($order_transport as $o_trans)
                <tr>
                  <td>{{$i}}</td>
                  <td>Transport</td>
                  @if(\Auth::user()->role == 'owner')
                  <td>{{$o_trans->cost_pcs}}</td>  
                  @endif
                  <td>{{$o_trans->amount_pcs}}</td> 
                </tr>
                <?php $i++;$total_cost+=$o_trans->cost_pcs;$total_price+=$o_trans->amount_pcs;?>
            @endforeach
            <tr>
                <td colspan="2" align="center"><b>TOTAL PRICE</b></td>
                @if(\Auth::user()->role == 'owner')
                <td><b>({{$total_cost}})</b></td>
                @endif
                <td><b>({{$total_price}})</b></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        @if(\Auth::user()->role == 'owner')
      <div class="col-xs-6">
        <p class="lead">COGS</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal Per PCS:</th>
              <td><b>IDR {{ number_format($p_total_cost+$total_cost,2) }}</b></td>
            </tr>
            @if(count($order_overhead) > 0)
                @foreach($order_overhead as $o_over)
                    @if($o_over->amount > 0)
                        <?php // $overhead = ($p_total_cost+$total_cost)*($o_over->amount/100); ?>
                        <tr>
                            <th style="width:50%">Overhead Per PCS:</th>
                            <td><b>IDR {{ number_format($o_over->amount,2) }}</b></td>
                        </tr>
                    @endif
    <!--                @if($o_over->profit > 0)
                        <?php // $profit = ($p_total_cost+$total_cost)*($o_over->profit/100); ?>
                        <tr>
                            <th style="width:50%">Profit Per PCS:</th>
                            <td><b>IDR {{ number_format($o_over->profit,2) }}</b></td>
                        </tr>
                    @endif-->
                @endforeach
            @endif
            <tr>
                <td colspan="2">--------------------------------------------------</td>
            </tr>
            <tr style="font-size: 18px;">
              <th>Total per PCS:</th>
              @if(isset($o_over->amount))
              <td><b>IDR {{number_format(($p_total_cost+$total_cost+$o_over->amount),2)}}</b></td>
              @else
              <td><b>IDR {{number_format(($p_total_cost+$total_cost),2)}}</b></td>
              @endif
            </tr>
            <tr>
              <th>Monthly:</th>
              @if(isset($o_over->amount))
              <td><b>IDR {{number_format(($p_total_cost+$total_cost+$o_over->amount)*$monthly_qty)}}</b></td>
              @else
              <td><b>IDR {{number_format(($p_total_cost+$total_cost)*$monthly_qty)}}</b></td>
              @endif
            </tr>
            <tr>
              <th>Yearly:</th>
              @if(isset($o_over->amount))
              <td><b>IDR {{number_format(($p_total_cost+$total_cost+$o_over->amount)*($monthly_qty*12))}}</b></td>
              @else
              <td><b>IDR {{number_format(($p_total_cost+$total_cost)*($monthly_qty*12))}}</b></td>
              @endif
            </tr>
          </table>
        </div>
      </div>
        @endif
        <div class="col-xs-6">
        <p class="lead">PRICE</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal Per PCS:</th>
              <td><b>IDR {{ number_format($p_total_price+$total_price,2) }}</b></td>
            </tr>
            @if(count($order_overhead) > 0)
                @foreach($order_overhead as $o_over)
                    @if($o_over->amount > 0)
                        <?php // $overhead_price = ($p_total_price+$total_price)*($o_over->amount/100); ?>
                        <tr>
                            <th style="width:50%">Overhead Per PCS:</th>
                            <td><b>IDR {{ number_format($o_over->amount,2) }}</b></td>
                        </tr>
                    @endif
                    @if($o_over->profit > 0)
                        <?php // $profit_price = ($p_total_price+$total_price)*($o_over->profit/100); ?>
                        <tr>
                            <th style="width:50%">Profit Per PCS:</th>
                            <td><b>IDR {{ number_format($o_over->profit,2) }}</b></td>
                        </tr>
                    @endif
                @endforeach
            @endif
            <tr>
                <td colspan="2">--------------------------------------------------</td>
            </tr>
            <tr style="font-size: 18px;">
              <th>Total per PCS:</th>
              @if(isset($o_over->amount))
              <td><b>IDR {{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit),2)}}</b></td>
              @else
              <td><b>IDR {{number_format(($p_total_price+$total_price),2)}}</b></td>
              @endif
            </tr>
            <tr>
              <th>Monthly:</th>
              @if(isset($o_over->amount))
              <td><b>IDR {{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit)*$monthly_qty)}}</b></td>
              @else
              <td><b>IDR {{number_format(($p_total_price+$total_price)*$monthly_qty)}}</b></td>
              @endif
            </tr>
            <tr>
              <th>Yearly:</th>
              @if(isset($o_over->amount))
              <td><b>IDR {{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit)*($monthly_qty*12))}}</b></td>
              @else
              <td><b>IDR {{number_format(($p_total_price+$total_price)*($monthly_qty*12))}}</b></td>
              @endif
            </tr>
          </table>
        </div>
      </div>
        <div class="col-xs-12">
            <p class="lead">Overhead & Profit</p>
            <form class="form-horizontal" action="{{ route('update-order-detail', array($order->id,'overhead')) }}" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-sm-1 control-label">Overhead</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                <span class="input-group-addon">IDR</span>
                                    <input type="text" name="amount" class="form-control" placeholder="Overhead Amount" required>
                                </div>
                            </div>
                            <label class="col-sm-1 control-label">Profit</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                <span class="input-group-addon">IDR</span>
                                    <input type="text" name="profit" class="form-control" placeholder="Profit Amount" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                              <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            if(isset($o_over->amount)):
                $cost_pcs = $p_total_cost+$total_cost+$o_over->amount;
                $buffer_pcs = $p_total_price+$total_price+$o_over->amount+$o_over->profit;
            else:
                $cost_pcs = $p_total_cost+$total_cost;
                $buffer_pcs = $p_total_price+$total_price;
            endif;
                $profit_pcs = $buffer_pcs-$cost_pcs;
                $profit_margin = ($profit_pcs/$buffer_pcs)*100;
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
              <td style="text-align: right;"><b>{{number_format($profit_pcs*$monthly_qty)}}</b></td>
            </tr>
            <tr>
              <td>Yearly:</td>
              <td style="text-align: right;"><b>{{number_format($profit_pcs*($monthly_qty*12))}}</b></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    @endif
    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="{{route('download-pdf-order', $order->id)}}" class="btn btn-default"><i class="fa fa-print"></i> Download PDF</a>
        <!--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->
        <a href="{{route('send-email-order', $order->id)}}" onclick="return confirm('Are you sure ?')" class="btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-envelope"></i> SEND EMAIL
        </a>
      </div>
    </div>
</section>
    
@endsection

@section('custom_js')

@endsection