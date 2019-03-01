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
                
                @foreach($order_product as $o_prod)
                    <div class="header" style="text-align: center;">
                        <img src="{{ asset("image/Logo.png")}}" style="width: 200px;" />
                        <hr  color='#f6f6f6' style="margin: 30px;" />
                        <h3>DATA SPESIFIKASI PRODUK</h3>
                        <h2>{{$o_prod->name}}</h2>
                        <img src="{{ asset("uploads/product/".$o_prod->photo)}}" width="250" />
                        <hr color='#f6f6f6' style="margin: 30px;" />
                    </div>
                    <div class="desc-produk">
                        <div class="column">
                            <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                <tr>
                                    <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Nama Customer</td>
                                    <td style="padding: 15px;text-align: center;">
                                        <p><b>{{$o_prod->customer_name}}</b></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @if(count($o_prod->materials) > 0)
                            <div class="column">
                                <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                    <tr>
                                        <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Material Produk</td>
                                        <td style="padding: 15px;text-align: center;">
                                            @foreach($o_prod->materials as $material)
                                                <p><b>{{$material->material_name}} - {{$material->qty.' Kg'}}</b></p>
                                            @endforeach  
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        
                        <div class="column">
                            <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                <tr>
                                    <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Berat</td>
                                    <td style="padding: 15px;text-align: center;">
                                        <p><b>Prediksi : {{$o_prod->weight_pre.' Gram'}}</b></p>
                                        <p><b>Buffer : {{$o_prod->weight_buff.' Gram'}}</b></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="column">
                            <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                <tr>
                                    <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Estimasi Order</td>
                                    <td style="padding: 15px;text-align: center;">
                                        <p><b>{{number_format($o_prod->quantity).' pcs / Month'}}</b></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="column">
                            <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                <tr>
                                    <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Perkiraan CT</td>
                                    <td style="padding: 15px;text-align: center;">
                                        <p><b>{{$o_prod->cycle_time.' Detik'}}</b></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @if(count($o_prod->machines) > 0)
                            <div class="column">
                                <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                    <tr>
                                        <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Mesin Yang Digunakan</td>
                                        <td style="padding: 15px;text-align: center;">
                                            @foreach($o_prod->machines as $machine)
                                                <p><b>{{$machine->machine_name}}</b></p>
                                            @endforeach
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        <div class="column">
                            <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                <tr>
                                    <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Jumlah Cavity</td>
                                    <td style="padding: 15px;text-align: center;">
                                        <p><b>{{$o_prod->cavity.' Cavity'}}</b></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @if(count($o_prod->moulds) > 0)
                            <div class="column">
                                <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                    <tr>
                                        <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Mould Yang Digunakan</td>
                                        <td style="padding: 15px;text-align: center;">
                                            @foreach($o_prod->moulds as $mould)
                                                <p><b>{{$mould->mould_name}}</b></p>
                                            @endforeach
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif 
                        
                        <div class="column">
                            <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                                <tr>
                                    <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Estimasi Lama Produksi (22Jam X 7Hari)</td>
                                    <td style="padding: 15px;text-align: center;">
                                        <p><b>{{$o_prod->qty_prod}} Hari</b></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                @endforeach
                <br /><br />
                <hr />
                <br />
                <div class="header" style="text-align: center;">
                    <h3>PERHITUNGAN HARGA PRODUK</h3>
                </div>
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
                                    <td>{{$o_prod->name}}</td>
                                    <td style="vertical-align: middle;text-align: center;">{{number_format($o_prod->quantity)}}</td>
                                    <td style="vertical-align: middle;text-align: center;"><b>{{number_format($o_prod->material_cost, 2)}}</b></td>  
                                    <td style="vertical-align: middle;text-align: center;"><b>{{number_format($o_prod->mould_cost, 2)}}</b></td> 
                                    <td style="vertical-align: middle;text-align: center;"><b>{{number_format($o_prod->machine_cost, 2)}}</b></td> 
                                    <td style="vertical-align: middle;text-align: center;"><b>{{number_format($o_prod->material_buffer, 2)}}</b></td> 
                                    <td style="vertical-align: middle;text-align: center;"><b>{{number_format($o_prod->mould_buffer, 2)}}</b></td>
                                    <td style="vertical-align: middle;text-align: center;"><b>{{number_format($o_prod->machine_buffer, 2)}}</b></td>
                                </tr>
                                <?php
                                    $p_total_cost+=$o_prod->material_cost+$o_prod->mould_cost+$o_prod->machine_cost;
                                    $p_total_price+=$o_prod->material_buffer+$o_prod->mould_buffer+$o_prod->machine_buffer;
                                    $monthly_qty+=$o_prod->quantity;
                                ?>
                                @if(count($o_prod->materials) > 0)
                                    <tr style="background: aquamarine;">
                                        <th colspan="3">Material Name</th>
                                        <th colspan="2">Quantity</th>
                                        <th colspan="2">Amount (Cost)</th>
                                        <th colspan="2">Amount (Buffer)</th>
                                    </tr>
                                    @foreach($o_prod->materials as $material)
                                    <tr>
                                        <td colspan="3">{{$material->material_name}}</td>
                                        <td colspan="2" style="text-align: center;">{{$material->qty.' Kg'}}</td>
                                        <td colspan="2" style="text-align: right;">{{number_format($material->cost)}}</td>
                                        <td colspan="2" style="text-align: right;">{{number_format($material->price)}}</td>
                                    </tr>
                                    @endforeach  
                                @endif
                                
                                @if(count($o_prod->moulds) > 0)
                                    <tr style="background: aquamarine;">
                                        <th colspan="3">Mould Name</th>
                                        <!--<th>Cavity</th>-->
                                        <th colspan="2">Depreciation</th>
                                        
                                        @if(\Auth::user()->role == 'owner')
                                        <th colspan="2">Amount (Cost)</th>
                                        @endif
                                        <th colspan="2">Amount (Buffer)</th>
                                    </tr>
                                    @foreach($o_prod->moulds as $mould)
                                    <tr>
                                        <td colspan="3">{{$mould->mould_name}}</td>
                                        <!--<td style="text-align: center;">{{$mould->cavity}}</td>-->
                                        <td colspan="2" style="text-align: center;">{{$mould->mould_depr.' Month'}}</td>
                                        <td colspan="2" style="text-align: right;">{{number_format($mould->mould_cost)}}</td>
                                        <td colspan="2" style="text-align: right;">{{number_format($mould->mould_buff)}}</td>
                                    </tr>
                                    @endforeach  
                                @endif
                                
                                @if(count($o_prod->machines) > 0)
                                    <tr style="background: aquamarine;">
                                        <th colspan="3">Machine Name</th>
                                        <!--<th>Cycle Time</th>-->
                                        <th colspan="2">Depreciation</th>
                                        <th colspan="2">Amount (Cost)</th>
                                        <th colspan="2">Amount (Buffer)</th>
                                    </tr>
                                    @foreach($o_prod->machines as $machine)
                                    <tr>
                                        <td colspan="3">{{$machine->machine_name}}</td>   
                                        <!--<td style="text-align: center;">{{$machine->cycle_time.' Sec'}}</td>-->
                                        <td colspan="2" style="text-align: center;">{{$machine->depreciation.' Year'}}</td>
                                        <td colspan="2" style="text-align: right;">{{number_format($machine->depr_amount)}}</td>
                                        <td colspan="2" style="text-align: right;">{{number_format($machine->amount)}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                <?php $i++;?>
                            @endforeach
                            <tr>
                                <td colspan="9" style="text-align: center;"><b>======================= TOTAL =======================</b></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right"><b>COST</b></td>
                                <td colspan="1" style="text-align: center;"><b>{{number_format($p_total_cost, 2)}}</b></td>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="2" align="right"><b>BUFFER</b></td>
                                <td colspan="2" style="text-align: center;"><b>{{number_format($p_total_price, 2)}}</b></td>
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
                              <td>Labour ({{$o_lab->qty.' Hari'}})</td>
                              <td style="text-align: center;">{{$o_lab->labour_cost}}</td>  
                              <td style="text-align: center;">{{$o_lab->labour_pcs}}</td> 
                            </tr>
                            <?php $i++;$total_cost+=$o_lab->labour_cost;$total_price+=$o_lab->labour_pcs;?>
                        @endforeach
                        @foreach($order_electricity as $o_ele)
                            <tr>
                              <td style="text-align: center;">{{$i}}</td>
                              <td>Electricity ({{$o_ele->days_needed.' Hari'}})</td>
                              <td style="text-align: center;">{{$o_ele->pcs_cost}}</td>  
                              <td style="text-align: center;">{{$o_ele->pcs}}</td> 
                            </tr>
                            <?php $i++;$total_cost+=$o_ele->pcs_cost;$total_price+=$o_ele->pcs;?>
                        @endforeach
                        @foreach($order_packaging as $o_pack)
                            <tr>
                              <td style="text-align: center;">{{$i}}</td>
                              <td>Packaging ({{$o_pack->name}})</td>
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
                        <tr style="font-size: 16px;">
                          <td>Total COST per PCS:</td>
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
                        <tr style="font-size: 16px;">
                          <td>Selling Price per PCS:</td>
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
                        <p class="lead"><b>NET MARGIN</b></p>
                        <?php
                            $cost_pcs = $p_total_cost+$total_cost+$o_over->amount;
                            $buffer_pcs = $p_total_price+$total_price+$o_over->amount+$o_over->profit;
                            $profit_pcs = $buffer_pcs-$cost_pcs;
                            $profit_margin = ($profit_pcs/$buffer_pcs)*100;
                        ?>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td>Net margin per PCS:</td>
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