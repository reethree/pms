<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Orders Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Orders'
            ]
        ]; 
        
        $orders = \DB::table('orders')->paginate(10);
        
        $data['orders'] = $orders;
        
        return view('modules.order.index', $data);
    }
    
    public function preview($id)
    {
        $data['page_title'] = "Orders Preview";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Orders'
            ],
            [
                'action' => '',
                'title' => 'Preview'
            ]
        ]; 
        
        $order = \DB::table('orders')->find($id);
        
        $order_product = \DB::table('order_product')
                ->select('order_product.*','products.name as product_name','products.weight_buff','products.efficiency_buffer')
                ->leftjoin('products', 'order_product.product_id', '=', 'products.id')
                ->where('order_id', $id)
                ->get();
        
        foreach ($order_product as $op):
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
        
        return view('modules.order.preview', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Order";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-order'),
                'title' => 'Order'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        $data['customers'] = \DB::table('customer')->get();
        
        return view('modules.order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);        
        
        $insert_id = \DB::table('orders')->insertGetId($data);
        
        if($insert_id){
            
            return redirect()->route('edit-order', $insert_id)->with('success', 'Order has been added.');
        }
        
        return back()->withInput();
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
        $data['page_title'] = "Edit Order";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-order'),
                'title' => 'Order'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['order'] = \DB::table('orders')->find($id);
        $order_product = \DB::table('order_product')
                ->select('order_product.*','products.name as product_name','products.weight_buff','products.efficiency_buffer')
                ->leftjoin('products', 'order_product.product_id', '=', 'products.id')
                ->where('order_id', $id)
                ->get();
        
        $order_labour = \DB::table('order_labour')->where('order_id', $id)->get();
        $order_electricity = \DB::table('order_electricity')->where('order_id', $id)->get();        
        $order_packaging = \DB::table('order_packaging')->where('order_id', $id)->get();
        $order_transport = \DB::table('order_transport')->where('order_id', $id)->get();
        $order_overhead = \DB::table('order_overhead')->where('order_id', $id)->get();
        
        foreach ($order_product as $op):
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
            
            $op->machines = $data_machines;
            $op->moulds = $data_moulds;
        endforeach;
        
        $data['order_product'] = $order_product;
        $data['order_labour'] = $order_labour;
        $data['order_electricity'] = $order_electricity;
        $data['order_packaging'] = $order_packaging;
        $data['order_transport'] = $order_transport;
        $data['order_overhead'] = $order_overhead;
        
        $data['products'] = \DB::table('products')->get();
        
        return view('modules.order.edit', $data);
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

    public function updateDetail(Request $request, $order_id, $type)
    {
        $data = $request->except(['_token']); 
        $insert_id = false;
        
        if($type == 'product'){
        
            $product = \DB::table('products')->find($data['product_id']);

            // Mould Calculation
            $sum_mould = \DB::table('product_mould')->where('product_id', $product->id)->sum('mould_buff');
            $sum_mould_cost = \DB::table('product_mould')->where('product_id', $product->id)->sum('mould_cost');
            $mould_buffer = $sum_mould/($data['quantity']*12);
            $mould_cost = $sum_mould_cost/($data['quantity']*12);

            // Machine Calculation
            $sum_machine = \DB::table('product_machine')->where('product_id', $product->id)->sum('amount');
            $sum_machine_cost = \DB::table('product_machine')->where('product_id', $product->id)->sum('depr_amount');
            $machine_buffer = $sum_machine/($data['quantity']*12);
            $machine_cost = $sum_machine_cost/($data['quantity']*12);

            // Material Calculation
            $materials = \DB::table('product_material')->where('product_id', $product->id)->get();
            
            $qty_buffer = round((1000/$product->weight_buff)*($product->efficiency_buffer/100));
            $qty_cost = round((1000/$product->weight_pre)*($product->efficiency_actual/100));
            
            $sum_material_amount = 0;$sum_material_cost = 0;$sum_material_qty = 0;
            foreach ($materials as $material):
                if($material->packing == 'Kg'){
                    $m_qty = $material->qty;
                }else{
                    $m_qty = ($material->qty/1000);
                }
                $m_amount = $material->price*$m_qty;
                $c_amount = $material->cost*$m_qty;

                $sum_material_qty += $m_qty;
                $sum_material_cost += $c_amount;
                $sum_material_amount += $m_amount;
            endforeach;
            
            $material_kg = round($sum_material_amount/$sum_material_qty);
            $material_kg_cost = round($sum_material_cost/$sum_material_qty);
            $material_buffer = $material_kg/$qty_buffer;
            $material_cost = $material_kg_cost/$qty_cost;
            
            $data['order_id'] = $order_id;
            $data['mould_buffer'] = round($mould_buffer, 2);
            $data['machine_buffer'] = round($machine_buffer, 2);
            $data['material_buffer'] = round($material_buffer, 2);
            
            $data['mould_cost'] = round($mould_cost, 2);
            $data['machine_cost'] = round($machine_cost, 2);
            $data['material_cost'] = round($material_cost, 2);

            $insert_id = \DB::table('order_product')->insertGetId($data);
            
        }elseif($type == 'labour'){
            $cost_monthly = (str_replace(",", "", $data['cost_head_day'])*$data['qty']);
            $amount_monthly = ($data['amount']*$data['qty']);
            
            $sum_product_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('quantity');
            
            $data['cost'] = str_replace(",", "", $data['cost']);
            $data['shift'] = str_replace(",", "", $data['shift']);
            $data['cost_head'] = str_replace(",", "", $data['cost_head']);
            $data['cost_head_day'] = str_replace(",", "", $data['cost_head_day']);
            
//            $data['amount_monthly'] = $amount_monthly;
//            $data['sum_product_qty'] = $sum_product_qty;
            
            $data['order_id'] = $order_id;
            $data['labour_cost'] = round($cost_monthly/$sum_product_qty,2);
            $data['labour_pcs'] = round($amount_monthly/$sum_product_qty,2);
            
            $insert_id = \DB::table('order_labour')->insertGetId($data);
            
        }elseif($type == 'electricity'){
            $sum_product_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('quantity');
            $data['order_id'] = $order_id;
            $data['max_bill'] = str_replace(',', '', $data['max_bill']);
            $data['min_bill'] = str_replace(',', '', $data['min_bill']);
            $data['avg_bill'] = str_replace(',', '', $data['avg_bill']);
            
            $pcs = (($data['amount']/25)/$data['total_machine'])*$data['days_needed'];
            
            $data['pcs'] = round($pcs/$sum_product_qty, 2);
            
            $insert_id = \DB::table('order_electricity')->insertGetId($data);  
            
        }elseif($type == 'packaging'){
            $data['order_id'] = $order_id;
            $qty = $data['pack_qty']*$data['prod_qty'];
            
            $data['cost_pcs'] = round($data['cost']/$qty, 2);
            $data['amount_pcs'] = round($data['amount']/$qty, 2);
            
            $insert_id = \DB::table('order_packaging')->insertGetId($data);           
        }elseif($type == 'transport'){
            $data['order_id'] = $order_id;
            $sum_product_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('quantity');
            
            $data['cost_pcs'] = round($data['cost']/$sum_product_qty, 2);
            $data['amount_pcs'] = round($data['amount']/$sum_product_qty, 2);
            
            $insert_id = \DB::table('order_transport')->insertGetId($data); 
        }elseif($type == 'overhead'){
            $data['order_id'] = $order_id;
//            $sum_product_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('quantity');
//            $data['max'] = str_replace(',', '', $data['max']);
//            $data['min'] = str_replace(',', '', $data['min']);
//            $data['avg'] = str_replace(',', '', $data['avg']);
//            $data['amount_pcs'] = round($data['amount']/$sum_product_qty, 2);
            
            $insert_id = \DB::table('order_overhead')->insertGetId($data); 
        }
        
        if($insert_id){   
            return back()->with('success', 'Order detail has been updated.');            
        }else{
            return back()->with('error', 'Ooopps, something wrong please try again.'); 
        }

    }
    
    public function destroyDetail($detail_id, $type)
    {
        if($type == 'product'){
            \DB::table('order_product')->where('id', $detail_id)->delete();
        }elseif($type == 'labour'){
            \DB::table('order_labour')->where('id', $detail_id)->delete();
        }elseif($type == 'electricity'){
            \DB::table('order_electricity')->where('id', $detail_id)->delete();
        }elseif($type == 'packaging'){
            \DB::table('order_packaging')->where('id', $detail_id)->delete();
        }elseif($type == 'transport'){
            \DB::table('order_transport')->where('id', $detail_id)->delete();
        }elseif($type == 'overhead'){
            \DB::table('order_overhead')->where('id', $detail_id)->delete();
        }
        
        
        return back()->with('success', 'Order detail has been deleted.');    
    }
    
}
