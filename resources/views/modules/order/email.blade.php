@extends('print')

@section('title')
    {{ 'Pricing Calculation' }}
@stop

@section('content')

<div class="wrap">

    <div class="container">
        <div class="red-line">
            <div></div>
        </div>
        <div class="content">                

            <div class="message">
                <!-- Table row -->
                <div class="row">
                  <div class="col-xs-12 table-responsive">
                    <table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>PRODUCT NAME</th>
                        <th>MONTHLY<br />QUANTITY</th>
                        <th>MATERIAL<br />(Cost)</th>
                        <th>MOULD<br />(Cost)</th>
                        <th>MACHINE<br />(Cost)</th>
                        <th>MATERIAL<br />(Buffer)</th>
                        <th>MOULD<br />(Buffer)</th>
                        <th>MACHINE<br />(Buffer)</th>
                      </tr>
                      </thead>
                      <tbody>
                            <?php $i = 1;$p_total_cost = 0;$p_total_price = 0;$monthly_qty = 0;?>
                            @foreach($order_product as $o_prod)
                                <tr>
                                    <td style="text-align: center;">{{$i}}</td>
                                    <td>{{$o_prod->product_name}}</td>
                                    <td style="text-align: center;">{{number_format($o_prod->quantity)}}</td>
                                    <td style="text-align: center;">{{$o_prod->material_cost}}</td>  
                                    <td style="text-align: center;">{{$o_prod->mould_cost}}</td> 
                                    <td style="text-align: center;">{{$o_prod->machine_cost}}</td> 
                                    <td style="text-align: center;">{{$o_prod->material_buffer}}</td> 
                                    <td style="text-align: center;">{{$o_prod->mould_buffer}}</td>
                                    <td style="text-align: center;">{{$o_prod->machine_buffer}}</td>
                                </tr>
                                <?php $i++;
                                    $p_total_cost+=$o_prod->material_cost+$o_prod->mould_cost+$o_prod->machine_cost;
                                    $p_total_price+=$o_prod->material_buffer+$o_prod->mould_buffer+$o_prod->machine_buffer;
                                    $monthly_qty+=$o_prod->quantity;
                                ?>
                            @endforeach
                            <tr>
                                <td colspan="3"><b>TOTAL PRICE</b></td>
                                <td colspan="2" align="right"><b>COST</b></td>
                                <td colspan="1" style="text-align: center;"><b>{{$p_total_cost}}</b></td>
                                <td colspan="2" align="right"><b>BUFFER</b></td>
                                <td colspan="1" style="text-align: center;"><b>{{$p_total_price}}</b></td>

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
                        <th>NAME</th>
                        <th>COST</th>
                        <th>BUFFER</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;$total_cost = 0;$total_price = 0;?>
                        @foreach($order_labour as $o_lab)
                            <tr>
                              <td style="text-align: center;">{{$i}}</td>
                              <td>Labour</td>
                              <td style="text-align: center;">{{$o_lab->labour_cost}}</td>  
                              <td style="text-align: center;">{{$o_lab->labour_pcs}}</td> 
                            </tr>
                            <?php $i++;$total_cost+=$o_lab->labour_cost;$total_price+=$o_lab->labour_pcs;?>
                        @endforeach
                        @foreach($order_electricity as $o_ele)
                            <tr>
                              <td style="text-align: center;">{{$i}}</td>
                              <td>Electricity</td>
                              <td style="text-align: center;">{{$o_ele->pcs}}</td>  
                              <td style="text-align: center;">{{$o_ele->pcs}}</td> 
                            </tr>
                            <?php $i++;$total_cost+=$o_ele->pcs;$total_price+=$o_ele->pcs;?>
                        @endforeach
                        @foreach($order_packaging as $o_pack)
                            <tr>
                              <td style="text-align: center;">{{$i}}</td>
                              <td>Packing ({{$o_pack->name}})</td>
                              <td style="text-align: center;">{{$o_pack->cost_pcs}}</td>  
                              <td style="text-align: center;">{{$o_pack->amount_pcs}}</td> 
                            </tr>
                            <?php $i++;$total_cost+=$o_pack->cost_pcs;$total_price+=$o_pack->amount_pcs;?>
                        @endforeach
                        @foreach($order_transport as $o_trans)
                            <tr>
                              <td style="text-align: center;">{{$i}}</td>
                              <td>Transport</td>
                              <td style="text-align: center;">{{$o_trans->cost_pcs}}</td>  
                              <td style="text-align: center;">{{$o_trans->amount_pcs}}</td> 
                            </tr>
                            <?php $i++;$total_cost+=$o_trans->cost_pcs;$total_price+=$o_trans->amount_pcs;?>
                        @endforeach
                        <tr>
                            <td colspan="2" align="center"><b>TOTAL PRICE</b></td>
                            <td style="text-align: center;"><b>{{$total_cost}}</b></td>
                            <td style="text-align: center;"><b>{{$total_price}}</b></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-xs-6" style="width: 48%; float: left;">
                        <p class="lead"><b>TOTAL COGS</b></p>

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td style="width:50%">Subtotal Per PCS:</td>
                          <td style="text-align: right;"><b>{{ number_format($p_total_cost+$total_cost,2) }}</b></td>
                        </tr>
                        @foreach($order_overhead as $o_over)
                            @if($o_over->amount > 0)
                                <?php // $overhead = ($p_total_cost+$total_cost)*($o_over->amount/100); ?>
                                <tr>
                                    <td style="width:50%">Overhead Per PCS:</td>
                                    <td style="text-align: right;"><b>{{ number_format($o_over->amount,2) }}</b></td>
                                </tr>
                            @endif
                            @if($o_over->profit > 0)
                                <?php // $profit = ($p_total_cost+$total_cost)*($o_over->profit/100); ?>
                                <tr>
                                    <td style="width:50%">Profit Per PCS:</td>
                                    <td style="text-align: right;"><b>----------</b></td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Total per PCS:</td>
                          <td style="text-align: right;"><b>{{number_format(($p_total_cost+$total_cost+$o_over->amount),2)}}</b></td>
                        </tr>
                        <tr>
                          <td>Monthly:</td>
                          <td style="text-align: right;"><b>{{number_format(($p_total_cost+$total_cost+$o_over->amount)*$monthly_qty)}}</b></td>
                        </tr>
                        <tr>
                          <td>Yearly:</td>
                          <td style="text-align: right;"><b>{{number_format(($p_total_cost+$total_cost+$o_over->amount)*($monthly_qty*12))}}</b></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                    <div class="col-xs-6" style="width: 48%; float: right;">
                        <p class="lead"><b>TOTAL BUFFER</b></p>

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td style="width:50%">Subtotal Per PCS:</td>
                          <td style="text-align: right;"><b>{{ number_format($p_total_price+$total_price,2) }}</b></td>
                        </tr>
                        @foreach($order_overhead as $o_over)
                            @if($o_over->amount > 0)
                                <?php // $overhead_price = ($p_total_price+$total_price)*($o_over->amount/100); ?>
                                <tr>
                                    <td style="width:50%">Overhead Per PCS:</td>
                                    <td style="text-align: right;"><b>{{ number_format($o_over->amount,2) }}</b></td>
                                </tr>
                            @endif
                            @if($o_over->profit > 0)
                                <?php // $profit_price = ($p_total_price+$total_price)*($o_over->profit/100); ?>
                                <tr>
                                    <td style="width:50%">Profit Per PCS:</td>
                                    <td style="text-align: right;"><b>{{ number_format($o_over->profit,2) }}</b></td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Total per PCS:</td>
                          <td style="text-align: right;"><b>{{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit),2)}}</b></td>
                        </tr>
                        <tr>
                          <td>Monthly:</td>
                          <td style="text-align: right;"><b>{{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit)*$monthly_qty)}}</b></td>
                        </tr>
                        <tr>
                          <td>Yearly:</td>
                          <td style="text-align: right;"><b>{{number_format(($p_total_price+$total_price+$o_over->amount+$o_over->profit)*($monthly_qty*12))}}</b></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div style="clear: both;"></div>
                <div class="row" style="display:block;">
                    <hr />
                    <div class="col-xs-6" style="width: 48%;">
                        <p class="lead"><b>TOTAL PROFIT</b></p>
                        <?php
                            $cost_pcs = $p_total_cost+$total_cost+$o_over->amount;
                            $buffer_pcs = $p_total_price+$total_price+$o_over->amount+$o_over->profit;
                            $profit_pcs = $buffer_pcs-$cost_pcs;
                            $profit_margin = ($profit_pcs/$buffer_pcs)*100;
                        ?>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td>Profit per PCS:</td>
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
                
            </div>
            
        </div>
        <div class="red-line">
            <div></div>
        </div>
    </div>

</div>
@stop