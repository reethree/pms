@extends('print')

@section('title')
    {{ 'Pricing Calculation' }}
@stop

@section('content')

<style>
.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

.left {
    float: left;
}

.right {
    float: right;
}

.text-right {
    text-align: right;
}

.text-center {
    text-align: center;
}

.text-left {
    text-align: left;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 100%;  
  height: 100%; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
}

#header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #000;
}

#title {
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  /*margin-bottom: 20px;*/
}

#client {
  padding-left: 6px;
  border-left: 6px solid #000;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
  font-size: 12px;
  border-color: #000;
}

table th,
table td {
  padding: 2px 0;
/*  background: #EEEEEE;*/
  /*text-align: center;*/
  /*border-bottom: 1px solid #FFFFFF;*/
}
table.table td {
    border-bottom: 1px solid #000;
}
table th {
  white-space: nowrap;        
  font-weight: normal;
  padding: 5px;
    border-bottom: 1px solid;
    font-weight: bold;
}

table td {
  text-align: left;
  padding: 3px;
}

table.grid td {
    border-right: 1px solid;
}

table td.padding-10 {
    padding: 0 10px;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border-bottom: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #000; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #000; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #000;  
}

#notices .notice {
  font-size: 1.2em;
}

#footer {
  /*color: #777777;*/
  width: 100%;
  /*height: 30px;*/
  position: absolute;
  bottom: 0;
  border-top: 1px solid #000;
  padding: 8px 0;
  text-align: center;
}
body{
                background:#f2f2f2;
                font-size: 14px;
                font-family: 'Open Sans', sans-serif;
            }
            .wrap{
                width: 100%;
                background:#f2f2f2;
            }
            .container{
                width:800px;
/*                max-width: 600px;*/
                margin: 0 auto;
                border: 1px solid #e3e3e3;
            }
            .content{
                background:#FFF;
                min-height:200px;
                padding:50px;
            }
            .red-line{
                background: #FFF;
            }
            .red-line div{
                border-top:8px solid #C1272D;
                width: 50%;
            }
            .logo{
                width:100%;   
            }
            .footer-logo{
                margin-top: 100px;
            }
            .logo img, .footer-logo img{
                width: 120px;
            }
            .sayhi{
                color:#666666;
            /*    font-family: 'Arial';*/
                padding-top: 30px;
            }
            .sayhi h2{
                font-size:16px;
            }
            .message{
                /*background:#F2F2F2;*/
                padding:5px 0;
                color:#000;
                font-size: 14px
            }
            .btn{
                margin-top:30px;
                margin-top:15px;
                width:160px;
                text-align: center;
                display: block;
                font-family: 'Arial';
                padding:10px 20px;
                background:#C1272D;
                color:#FFF;
                text-decoration: none;
            }
            h2{
                font-weight: normal;
            }
            
            /* ----------- iPhone 4 and 4S ----------- */

            /* Portrait and Landscape */
            @media only screen 
              and (min-device-width: 320px) 
              and (max-device-width: 480px)
              and (-webkit-min-device-pixel-ratio: 2) {
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Portrait */
            @media only screen 
              and (min-device-width: 320px) 
              and (max-device-width: 480px)
              and (-webkit-min-device-pixel-ratio: 2)
              and (orientation: portrait) {
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Landscape */
            @media only screen 
              and (min-device-width: 320px) 
              and (max-device-width: 480px)
              and (-webkit-min-device-pixel-ratio: 2)
              and (orientation: landscape) {
                  img.image-laptop{
                      display: none;
                  }
            }

            /* ----------- iPhone 5 and 5S ----------- */

            /* Portrait and Landscape */
            @media only screen 
              and (min-device-width: 320px) 
              and (max-device-width: 568px)
              and (-webkit-min-device-pixel-ratio: 2) {
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Portrait */
            @media only screen 
              and (min-device-width: 320px) 
              and (max-device-width: 568px)
              and (-webkit-min-device-pixel-ratio: 2)
              and (orientation: portrait) {
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Landscape */
            @media only screen 
              and (min-device-width: 320px) 
              and (max-device-width: 568px)
              and (-webkit-min-device-pixel-ratio: 2)
              and (orientation: landscape) {
                  img.image-laptop{
                      display: none;
                  }
            }

            /* ----------- iPhone 6 ----------- */

            /* Portrait and Landscape */
            @media only screen 
              and (min-device-width: 375px) 
              and (max-device-width: 667px) 
              and (-webkit-min-device-pixel-ratio: 2) { 
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Portrait */
            @media only screen 
              and (min-device-width: 375px) 
              and (max-device-width: 667px) 
              and (-webkit-min-device-pixel-ratio: 2)
              and (orientation: portrait) { 
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Landscape */
            @media only screen 
              and (min-device-width: 375px) 
              and (max-device-width: 667px) 
              and (-webkit-min-device-pixel-ratio: 2)
              and (orientation: landscape) { 
                  img.image-laptop{
                      display: none;
                  }
            }

            /* ----------- iPhone 6+ ----------- */

            /* Portrait and Landscape */
            @media only screen 
              and (min-device-width: 414px) 
              and (max-device-width: 736px) 
              and (-webkit-min-device-pixel-ratio: 3) { 
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Portrait */
            @media only screen 
              and (min-device-width: 414px) 
              and (max-device-width: 736px) 
              and (-webkit-min-device-pixel-ratio: 3)
              and (orientation: portrait) { 
                  img.image-laptop{
                      display: none;
                  }
            }

            /* Landscape */
            @media only screen 
              and (min-device-width: 414px) 
              and (max-device-width: 736px) 
              and (-webkit-min-device-pixel-ratio: 3)
              and (orientation: landscape) { 
                  img.image-laptop{
                      display: none;
                  }
            }
@media print {
    body {
        color: #000;
        background: #fff;
    }
    @page {
        size: auto;   /* auto is the initial value */
        margin-top: 114px;
        margin-bottom: 90px;
        margin-left: 38px;
        margin-right: 75px;
        font-weight: bold;
    }
    .print-btn {
        display: none;
    }
}
</style>

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
                                <td colspan="1" style="text-align: center;"><b>({{$p_total_cost}})</b></td>
                                <td colspan="2" align="right"><b>BUFFER</b></td>
                                <td colspan="1" style="text-align: center;"><b>({{$p_total_price}})</b></td>

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
                            <td style="text-align: center;"><b>({{$total_cost}})</b></td>
                            <td style="text-align: center;"><b>({{$total_price}})</b></td>
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