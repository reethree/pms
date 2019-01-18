@extends('main-layout')

@section('content')
<?php $overhead = 0;$overhead_price = 0;$profile = 0;$profile_price = 0;?>
<!--<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orders Preview</h3>
        </div>
         /.box-header 
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
       /.box 
    </div>
</div>-->

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
    <!-- info row -->
<!--    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, Inc.</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
       /.col 
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>John Doe</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (555) 539-1037<br>
          Email: john.doe@example.com
        </address>
      </div>
       /.col 
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567
      </div>
       /.col 
    </div>-->
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Monthly Qty</th>
            @if(\Auth::user()->role == 'owner')
            <th>Material Cost</th>
            <th>Mould Cost</th>
            <th>Machine Cost</th>
            @endif
            <th>Material Price</th>
            <th>Mould Price</th>
            <th>Machine Price</th>
          </tr>
          </thead>
          <tbody>
                <?php $i = 1;$p_total_cost = 0;$p_total_price = 0;$monthly_qty = 0;?>
                @foreach($order_product as $o_prod)
                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$o_prod->product_name}}</td>
                      <td>{{number_format($o_prod->quantity)}}</td>
                      @if(\Auth::user()->role == 'owner')
                      <td>{{$o_prod->material_cost}}</td>  
                      <td>{{$o_prod->mould_cost}}</td> 
                      <td>{{$o_prod->machine_cost}}</td> 
                      @endif
                      <td>{{$o_prod->material_buffer}}</td> 
                      <td>{{$o_prod->mould_buffer}}</td>
                      <td>{{$o_prod->machine_buffer}}</td>
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
                    <td colspan="2"><b>({{$p_total_cost}})</b></td>
                    <td colspan="2" align="right"><b>TOTAL PRICE</b></td>
                    <td colspan="2"><b>({{$p_total_price}})</b></td>
                    @else
                    <td colspan="5" align="center"><b>TOTAL PRICE</b></td>
                    <td colspan="2"><b>({{$p_total_price}})</b></td>
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
                  <td>Labour</td>
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
                  <td>Electricity</td>
                  @if(\Auth::user()->role == 'owner')
                  <td>{{$o_ele->pcs}}</td>  
                  @endif
                  <td>{{$o_ele->pcs}}</td> 
                </tr>
                <?php $i++;$total_cost+=$o_ele->pcs;$total_price+=$o_ele->pcs;?>
            @endforeach
            @foreach($order_packaging as $o_pack)
                <tr>
                  <td>{{$i}}</td>
                  <td>Packing ({{$o_pack->name}})</td>
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
            <tr>
                <td colspan="2">--------------------------------------------------</td>
            </tr>
            <tr>
              <th>Total per PCS:</th>
              <td><b>IDR {{number_format(($p_total_cost+$total_cost+$o_over->amount),2)}}</b></td>
            </tr>
            <tr>
              <th>Monthly:</th>
              <td><b>IDR {{number_format(($p_total_cost+$total_cost+$o_over->amount)*$monthly_qty)}}</b></td>
            </tr>
            <tr>
              <th>Yearly:</th>
              <td><b>IDR {{number_format(($p_total_cost+$total_cost+$o_over->amount)*($monthly_qty*12))}}</b></td>
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
            <tr>
                <td colspan="2">--------------------------------------------------</td>
            </tr>
            <tr>
              <th>Total per PCS:</th>
              <td><b>IDR {{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit),2)}}</b></td>
            </tr>
            <tr>
              <th>Monthly:</th>
              <td><b>IDR {{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit)*$monthly_qty)}}</b></td>
            </tr>
            <tr>
              <th>Yearly:</th>
              <td><b>IDR {{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit)*($monthly_qty*12))}}</b></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
<!--        <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
        </button>-->
        <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
          <i class="fa fa-envelope"></i> SEND EMAIL
        </button>
      </div>
    </div>
</section>
    
@endsection

@section('custom_js')

@endsection