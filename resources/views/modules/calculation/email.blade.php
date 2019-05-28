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
                
                <div class="header" style="text-align: center;">
                    <img src="{{ asset("image/Logo.png")}}" style="width: 200px;" />
                    <hr  color='#f6f6f6' style="margin: 30px;" />
                    <h3>DATA SPESIFIKASI PRODUK</h3>
                    <h2>{{$master['product']->name}}</h2>
                    <img src="{{ asset("uploads/product/".$master['product']->photo)}}" width="250" />
                    <hr color='#f6f6f6' style="margin: 30px;" />
                </div>
                <div class="desc-produk">
                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Nama Customer</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{$master['customer']->name}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Material Produk</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{$master['material']->name}} - {{$calc->material_weight.' Kg'}}</b></p>
                                    <p><b>{{$master['masterbatch']->name}} - {{$calc->masterbatch_weight.' Kg'}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Berat</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>Prediksi : {{$calc->weight.' Gram'}}</b></p>
                                    <p><b>Buffer : {{$calc->weight_buffer.' Gram'}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Estimasi Order</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{number_format($calc->quantity).' pcs / Month'}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Perkiraan CT</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{$calc->cycle_time.' Detik'}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Mesin Yang Digunakan</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{$master['machine']->name}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Jumlah Cavity</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{$calc->cavity.' Cavity'}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Mould Yang Digunakan</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{$master['mould']->name}}</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="column">
                        <table style="border: 1px solid #CCC;margin-bottom: 5px;">
                            <tr>
                                <td style="padding: 15px;text-align: center;border-right: 1px solid #CCC;width: 50%;">Estimasi Lama Produksi</td>
                                <td style="padding: 15px;text-align: center;">
                                    <p><b>{{$calc->days_needed_buffer}} Hari</b></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <br /><br />
                <hr />
                <br />
                <div class="header" style="text-align: center;">
                    <h3>PERHITUNGAN HARGA PRODUK</h3>
                </div>
                <!-- Table row -->
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
                        <tr>
                          <td style="text-align: center;">1</td>
                          <td>Material</td>
                          <td style="text-align: center;">{{number_format($results['material']['actual'], 1)}}</td>  
                          <td style="text-align: center;">{{number_format($results['material']['buffer'], 1)}}</td> 
                        </tr>
                        <?php $total_cost+=$results['material']['actual'];$total_price+=$results['material']['buffer'];?>
                        
                        <tr>
                          <td style="text-align: center;">2</td>
                          <td>Machine</td>
                          <td style="text-align: center;">{{number_format($results['machine']['actual'], 1)}}</td>  
                          <td style="text-align: center;">{{number_format($results['machine']['buffer'], 1)}}</td> 
                        </tr>
                        <?php $total_cost+=$results['machine']['actual'];$total_price+=$results['machine']['buffer'];?>
                        
                        <tr>
                          <td style="text-align: center;">3</td>
                          <td>Mould</td>
                          <td style="text-align: center;">{{number_format($results['mould']['actual'], 1)}}</td>  
                          <td style="text-align: center;">{{number_format($results['mould']['buffer'], 1)}}</td> 
                        </tr>
                        <?php $total_cost+=$results['mould']['actual'];$total_price+=$results['mould']['buffer'];?>
                        
                        <tr>
                            <td style="text-align: center;">4</td>
                            <td>Labour ({{$calc->days_needed_buffer}} days)</td>
                            <td style="text-align: center;">{{number_format($results['labour']['actual'],1)}}</td>  
                            <td style="text-align: center;">{{number_format($results['labour']['buffer'],1)}}</td> 
                          </tr>
                          <?php $total_cost+=$results['labour']['actual'];$total_price+=$results['labour']['buffer'];?>
                        
                        <tr>
                            <td style="text-align: center;">5</td>
                            <td>Electricity ({{$calc->days_needed_buffer}} days)</td>
                            <td style="text-align: center;">{{number_format($results['elec']['actual'],1)}}</td>  
                            <td style="text-align: center;">{{number_format($results['elec']['buffer'],1)}}</td> 
                          </tr>
                          <?php $total_cost+=$results['elec']['actual'];$total_price+=$results['elec']['buffer'];?>

                          <tr>
                            <td style="text-align: center;">6</td>
                            <td>Packaging 1</td>
                            <td style="text-align: center;">{{number_format($results['packing1']['actual'],1)}}</td>  
                            <td style="text-align: center;">{{number_format($results['packing1']['buffer'],1)}}</td> 
                          </tr>
                          <?php $total_cost+=$results['packing1']['actual'];$total_price+=$results['packing1']['buffer'];?>

                          <tr>
                            <td style="text-align: center;">7</td>
                            <td>Packaging 2</td>
                            <td style="text-align: center;">{{number_format($results['packing2']['actual'],1)}}</td>  
                            <td style="text-align: center;">{{number_format($results['packing2']['buffer'],1)}}</td> 
                          </tr>
                          <?php $total_cost+=$results['packing2']['actual'];$total_price+=$results['packing2']['buffer'];?>

                          <tr>
                            <td style="text-align: center;">8</td>
                            <td>Transport</td>
                            <td style="text-align: center;">{{number_format($results['transport']['actual'],1)}}</td>  
                            <td style="text-align: center;">{{number_format($results['transport']['buffer'],1)}}</td> 
                          </tr>
                          <?php $total_cost+=$results['transport']['actual'];$total_price+=$results['transport']['buffer'];?>

                        <tr>
                            <td colspan="2" align="center"><b>TOTAL PRICE</b></td>
                            <td style="text-align: center;"><b>{{number_format($total_cost,1)}}</b></td>
                            <td style="text-align: center;"><b>{{number_format($total_price,1)}}</b></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <?php 
                    $subtot_cogs = $total_cost;
                    $overhead_cogs = $subtot_cogs*($calc->overhead/100);
                    $total_cogs = $subtot_cogs+$overhead_cogs;
                    
                    $subtot_sell = $total_price;
                    $overhead_sell = $subtot_sell*($calc->overhead/100);
                    $profit_sell = ($subtot_sell+$overhead_sell)*($calc->profit/100);
                    $total_sell = $subtot_sell+$overhead_sell+$profit_sell;      
                ?>
                <div class="row">
                    <div class="col-xs-6" style="width: 48%; float: left;">
                    <p class="lead"><b>TOTAL COGS</b></p>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td style="width:50%">Subtotal Per PCS:</td>
                          <td style="text-align: right;"><b>{{ number_format($total_cost,2) }}</b></td>
                        </tr>
                        <tr>
                            <td style="width:50%">Overhead Per PCS:</td>
                            <td style="text-align: right;"><b>{{ number_format($overhead_cogs,2) }}</b></td>
                        </tr>
                        <tr>
                            <td style="width:50%">Profit Per PCS:</td>
                            <td style="text-align: right;"><b>----------</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr style="font-size: 16px;">
                          <td>Total COST per PCS:</td>
                          <td style="text-align: right;"><b>{{number_format($total_cogs,2)}}</b></td>
                        </tr>
                        <tr>
                          <td>Monthly:</td>
                          <td style="text-align: right;"><b>{{number_format($total_cogs*$calc->quantity)}}</b></td>
                        </tr>
                        <tr>
                          <td>Yearly:</td>
                          <td style="text-align: right;"><b>{{number_format($total_cogs*($calc->quantity*12))}}</b></td>
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
                          <td style="text-align: right;"><b>{{ number_format($subtot_sell,2) }}</b></td>
                        </tr>
                        <tr>
                            <td style="width:50%">Overhead Per PCS:</td>
                            <td style="text-align: right;"><b>{{ number_format($overhead_sell,2) }}</b></td>
                        </tr>
                        <tr>
                            <td style="width:50%">Profit Per PCS:</td>
                            <td style="text-align: right;"><b>{{ number_format($profit_sell,2) }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr style="font-size: 16px;">
                          <td>Selling Price per PCS:</td>
                          <td style="text-align: right;"><b>{{number_format($total_sell,2)}}</b></td>
                        </tr>
                        <tr>
                          <td>Monthly:</td>
                          <td style="text-align: right;"><b>{{number_format($total_sell*$calc->quantity)}}</b></td>
                        </tr>
                        <tr>
                          <td>Yearly:</td>
                          <td style="text-align: right;"><b>{{number_format($total_sell*($calc->quantity*12))}}</b></td>
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
                            $cost_pcs = $total_cogs;
                            $buffer_pcs = $total_sell;
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
                
            </div>
            
        </div>
        <div class="red-line">
            <div></div>
        </div>
    </div>

</div>
@stop