<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Calculation Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Calculation'
            ]
        ]; 
        
//        $orders = \DB::table('orders')->paginate(10);
//        
//        $data['orders'] = $orders;
        
        return view('modules.calculation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function getDataCalculation()
    {
        $data['data'] = \DB::table('calculation')->get();
        return json_encode($data);
    }
    
    public function createDataCalculation()
    {
        $insert = \DB::table('calculation')->insertGetId(['name' => 'New Product','quantity' => 1]);
        return json_encode(array('success' => true,'message' => 'Create New Data','data' => array('id' => $insert)));
    }
    
    public function updateDataCalculation(Request $request)
    {
        $data = $request->all();
        $update = \DB::table('calculation')->where('id', $data['id'])->update([$data['key'] => $data['value']]);
        return json_encode(array('success' => true,'message' => 'Data Updated','data' => $data));
    }
    
    public function viewCalculation($id)
    {
        $data['page_title'] = "View Calculation";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Calculation'
            ],
            [
                'action' => route('index-calculation'),
                'title' => 'View'
            ]
        ]; 
        
        $data['products'] = \DB::table('products')->get();
        $data['customers'] = \DB::table('customer')->get();
        $data['machines'] = \DB::table('machines')->get();
        $data['moulds'] = \DB::table('mould')->get();
        $data['materials'] = \DB::table('materials')->get();
        
        $calc = \DB::table('calculation')->find($id);
        
        $res['time_eff'] = ($calc->time_efficiency * 86400)/100;
        $res['days_needed'] = $calc->quantity/(($calc->cavity/$calc->cycle_time)*$res['time_eff']);
        $res['mould'] = array(
            'actual' => ($calc->mould/$calc->mould_depr)/$calc->quantity,
            'buffer' => ($calc->mould_buffer/$calc->mould_depr_buffer)/$calc->quantity
        );
        $res['machine'] = array(
            'actual' => ($calc->days_needed_buffer/$calc->total_days)*($calc->machine/$calc->machine_depr)/$calc->quantity,
            'buffer' => ($calc->days_needed_buffer/$calc->total_days)*($calc->machine_buffer/$calc->machine_depr_buffer)/$calc->quantity
        );
        $res['material'] = array(
            'actual' => (((($calc->material*$calc->material_weight)+($calc->masterbatch*$calc->masterbatch_weight))/(($calc->material_efficiency/100)*($calc->material_weight+$calc->masterbatch_weight)))/1000)*$calc->weight,
            'buffer' => (((($calc->material_buffer*$calc->material_weight)+($calc->masterbatch_buffer*$calc->masterbatch_weight))/(($calc->material_efficiency/100)*($calc->material_weight+$calc->masterbatch_weight)))/1000)*$calc->weight_buffer
        );
        $res['labour'] = array(
            'actual' => (($calc->days_needed_buffer/$calc->working_day)*$calc->shift*$calc->labour)/$calc->quantity,
            'buffer' => (($calc->days_needed_buffer/$calc->working_day)*$calc->shift*$calc->labour_buffer)/$calc->quantity
        );
        $res['elec'] = array(
            'actual' => ((($calc->days_needed_buffer/$calc->total_days)*$calc->electricity)/$calc->total_machine)/$calc->quantity,
            'buffer' => ((($calc->days_needed_buffer/$calc->total_days)*$calc->electricity_buffer)/$calc->total_machine)/$calc->quantity
        );
        $res['transport'] = array(
            'actual' => $calc->transport/$calc->quantity,
            'buffer' => $calc->transport_buffer/$calc->quantity
        );
        $res['packing1'] = array(
            'actual' => $calc->packaging1/$calc->packaging1_qty,
            'buffer' => $calc->packaging1_buffer/$calc->packaging1_qty
        );
        $res['packing2'] = array(
            'actual' => $calc->packaging2/$calc->packaging2_qty,
            'buffer' => $calc->packaging2_buffer/$calc->packaging2_qty
        );

        $res['product'] = \DB::table('products')->find($calc->product_id);
        $res['customer'] = \DB::table('customer')->find($calc->customer_id);
        
        $data['calc'] = $calc;
        $data['results'] = $res;
        
        return view('modules.calculation.preview', $data);
    }
    
    public function updateDetailCalculation(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        
        $update = \DB::table('calculation')->where('id', $id)->update($data);
        
        if($update){
            return back()->with('success', 'Calculation has been updated.');  
        }
        
        return back()->with('error', 'Oooppss, something wrong.');  
    }
    
    public function sendEmail($id)
    {
        $calc = \DB::table('calculation')->find($id);
        
        $res['time_eff'] = ($calc->time_efficiency * 86400)/100;
        $res['days_needed'] = $calc->quantity/(($calc->cavity/$calc->cycle_time)*$res['time_eff']);
        $res['mould'] = array(
            'actual' => ($calc->mould/$calc->mould_depr)/$calc->quantity,
            'buffer' => ($calc->mould_buffer/$calc->mould_depr_buffer)/$calc->quantity
        );
        $res['machine'] = array(
            'actual' => ($calc->days_needed_buffer/$calc->total_days)*($calc->machine/$calc->machine_depr)/$calc->quantity,
            'buffer' => ($calc->days_needed_buffer/$calc->total_days)*($calc->machine_buffer/$calc->machine_depr_buffer)/$calc->quantity
        );
        $res['material'] = array(
            'actual' => (((($calc->material*$calc->material_weight)+($calc->masterbatch*$calc->masterbatch_weight))/(($calc->material_efficiency/100)*($calc->material_weight+$calc->masterbatch_weight)))/1000)*$calc->weight,
            'buffer' => (((($calc->material_buffer*$calc->material_weight)+($calc->masterbatch_buffer*$calc->masterbatch_weight))/(($calc->material_efficiency/100)*($calc->material_weight+$calc->masterbatch_weight)))/1000)*$calc->weight_buffer
        );
        $res['labour'] = array(
            'actual' => (($calc->days_needed_buffer/$calc->working_day)*$calc->shift*$calc->labour)/$calc->quantity,
            'buffer' => (($calc->days_needed_buffer/$calc->working_day)*$calc->shift*$calc->labour_buffer)/$calc->quantity
        );
        $res['elec'] = array(
            'actual' => ((($calc->days_needed_buffer/$calc->total_days)*$calc->electricity)/$calc->total_machine)/$calc->quantity,
            'buffer' => ((($calc->days_needed_buffer/$calc->total_days)*$calc->electricity_buffer)/$calc->total_machine)/$calc->quantity
        );
        $res['transport'] = array(
            'actual' => $calc->transport/$calc->quantity,
            'buffer' => $calc->transport_buffer/$calc->quantity
        );
        $res['packing1'] = array(
            'actual' => $calc->packaging1/$calc->packaging1_qty,
            'buffer' => $calc->packaging1_buffer/$calc->packaging1_qty
        );
        $res['packing2'] = array(
            'actual' => $calc->packaging2/$calc->packaging2_qty,
            'buffer' => $calc->packaging2_buffer/$calc->packaging2_qty
        );

        $master['product'] = \DB::table('products')->find($calc->product_id);
        $master['customer'] = \DB::table('customer')->find($calc->customer_id);
        $master['material'] = \DB::table('materials')->find($calc->material_id);
        $master['masterbatch'] = \DB::table('materials')->find($calc->masterbatch_id);
        $master['machine'] = \DB::table('machines')->find($calc->machine_id);
        $master['mould'] = \DB::table('mould')->find($calc->mould_id);
        
        $data['calc'] = $calc;
        $data['results'] = $res;
        $data['master'] = $master;
        
        return view('modules.calculation.email', $data);
        
//        $email = \Mail::send('modules.order.email', $data, function($message) {
//            $message->from('ppms@polimerindo.com', 'P-PMS');
//            $message->to('ppms-pricing@polimerindo.com','Polimerindo')->subject('Pricing Calculation');
//        });
        
//        if($email){
            return back()->with('success', 'Email has been send.'); 
//        }
        
//        return back()->with('error', 'Ooopps, something wrong please try again.'); 
        
    }
    
    public function downloadPdf($id)
    {
        $order = \DB::table('orders')->find($id);
        
        $order_product = \DB::table('order_product')
                ->select('order_product.*','products.*','customer.name as customer_name')
                ->leftjoin('products', 'order_product.product_id', '=', 'products.id')
                ->leftjoin('customer', 'products.customer_id', '=', 'customer.id')
                ->where('order_id', $id)
                ->get();
        
        foreach ($order_product as $op):
            if($op->quantity && $op->daily_qty){
                $op->qty_prod = round($op->quantity/$op->daily_qty);
            }else{
                $op->qty_prod = 0;
            }
            
            $data_machines = \DB::table('product_machine')
                ->select('product_machine.*','machines.name as machine_name')
                ->leftjoin('machines', 'product_machine.machine_id','=','machines.id')
                ->where('product_id', $op->product_id)
                ->get();
            
            $data_moulds = \DB::table('product_mould')
                ->select('product_mould.*','mould.name as mould_name','mould.no_of_cavity as cavity')
                ->leftjoin('mould', 'product_mould.mould_id','=','mould.id')
                ->where('product_id', $op->product_id)
                ->get();
            
            $data_materials = \DB::table('product_material')
                ->select('product_material.*','materials.name as material_name')
                ->leftjoin('materials', 'product_material.material_id','=','materials.id')
                ->where('product_id', $op->product_id)
                ->get();
            
            $op->materials = $data_materials;
            $op->machines = $data_machines;
            $op->moulds = $data_moulds;
        endforeach;
        
        $order_labour = \DB::table('order_labour')->where('order_id', $id)->get();
        $order_electricity = \DB::table('order_electricity')->where('order_id', $id)->get();        
        $order_packaging = \DB::table('order_packaging')->where('order_id', $id)->get();
        $order_transport = \DB::table('order_transport')->where('order_id', $id)->get();
        $order_overhead = \DB::table('order_overhead')->where('order_id', $id)->get();

        $data['order'] = $order;     
        $data['order_product'] = $order_product;
        $data['order_labour'] = $order_labour;
        $data['order_electricity'] = $order_electricity;
        $data['order_packaging'] = $order_packaging;
        $data['order_transport'] = $order_transport;
        $data['order_overhead'] = $order_overhead;
        
        $pdf = \PDF::loadView('modules.order.pdf', $data);
        return $pdf->download('P-PMS '.$order->number.'.pdf');
    }
}
