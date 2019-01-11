<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Products Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Products'
            ]
        ]; 
        
        $products = \DB::table('products')
                ->select('products.*','customer.name as customer_name')
                ->leftjoin('customer', 'products.customer_id','=','customer.id')
                ->paginate(10);
        
        $data['products'] = $products;
        
        return view('modules.product.index', $data);
    }
    
    public function getTable()
    {
        $products = \DB::table('products');
        return \Datatables::of($products)
                ->addColumn('action', function ($product) {
                    return '<a href="'.route('edit-product', $product->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>'
                    . '&nbsp;<a href="'.route('delete-product', $product->id).'" onclick="if(!confirm(\'Are you sure want to delete?\')){return false;}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                })
                ->editColumn('status', function ($product) {
                    return ucfirst($product->status);
                })
                ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Product";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-product'),
                'title' => 'Product'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        $data['customers'] = \DB::table('customer')->get();
        $data['groups'] = \DB::table('group_category')->get();
        
        return view('modules.product.create', $data);
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
        
        $insert_id = \DB::table('products')->insertGetId($data);
        
        if($insert_id){
            
//            if($data['material_group_id']){
                // insert from material group
//                $materials = \DB::table('material_group')
//                        ->select('materials.*')
//                        ->leftjoin('materials', 'materials.id', '=', 'material_group.material_id')
//                        ->where('material_group.group_id', $data['material_group_id'])
//                        ->get();
//                
//                return $materials;
//            }
            
            return redirect()->route('edit-product', $insert_id)->with('success', 'Product has been added.');
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
        $data['page_title'] = "Edit Product";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-product'),
                'title' => 'Product'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['product'] = \DB::table('products')->find($id);
        
        $data['customers'] = \DB::table('customer')->get();
        $data['moulds'] = \DB::table('mould')->get();
        $data['machines'] = \DB::table('machines')->get();
        
        $materials = \DB::table('materials')->get();
        foreach ($materials as $material):
            $material->price_last = $this->getLastMaterialPrice($material->id);
        endforeach;
        
        $data['materials'] = $materials;
        
        $data['groups'] = \DB::table('group_category')->get();
        
        // MOULD
        $data_moulds = \DB::table('product_mould')
                ->select('product_mould.*','mould.name as mould_name','mould.no_of_cavity as cavity')
                ->leftjoin('mould', 'product_mould.mould_id','=','mould.id')
                ->where('product_id', $id)
                ->get();
        $data['product_moulds'] = $data_moulds;
        
        // MACHINE
        $data_machines = \DB::table('product_machine')
                ->select('product_machine.*','machines.name as machine_name')
                ->leftjoin('machines', 'product_machine.machine_id','=','machines.id')
                ->where('product_id', $id)
                ->get();
        $data['product_machines'] = $data_machines;
        
        // MATERIAL
        $data_materials = \DB::table('product_material')
                ->select('product_material.*','materials.name as material_name','materials.type as material_type')
                ->leftjoin('materials', 'product_material.material_id','=','materials.id')
                ->where('product_id', $id)
                ->get();
        $data['product_materials'] = $data_materials;
        
        $data['rate'] = $this->getCurrencyByName('USD');
        
        return view('modules.product.edit', $data);
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
        $data = $request->except(['_token']);        
        
        $update = \DB::table('products')->where('id',$id)->update($data);
        
        if($update){
            
            return back()->with('success', 'Product has been updated.');
        }
        
        return back()->withInput();
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
    
    public function updateDetail(Request $request, $product_id, $type)
    {
        $data = $request->except(['_token']);        

        $product = \DB::table('products')->find($product_id);
        
        $data['product_id'] = $product_id;
        
        if($type == 'mould'){
            $data['mould_cost'] = str_replace(',', '', $request->mould_cost);           
//            $qty = $product->monthly_qty * 12;
//            $data['mould_pcs'] = $data['mould_buff'] / $qty;
            
            $insert_id = \DB::table('product_mould')->insertGetId($data);
        }elseif($type == 'machine'){
            $data['depr_amount'] = $data['cost']/$data['depreciation'];
            $insert_id = \DB::table('product_machine')->insertGetId($data);
        }elseif($type == 'material'){
            if(isset($data['product_material_id'])){
                $insert_id = \DB::table('product_material')->where('id',$data['product_material_id'])->update(['price'=>$data['price'],'qty'=>$data['qty']]);
            }else{
                $insert_id = \DB::table('product_material')->insertGetId($data);
            }  
        }
        
        if($insert_id){   
            return back()->with('success', 'Product detail has been updated.');            
        }
        
        return back()->with('error', 'Ooops, something wrong please try again.');
    }
    
    public function destroyDetail($detail_id, $type)
    {
        if($type == 'mould'){
            \DB::table('product_mould')->where('id', $detail_id)->delete();
        }elseif($type == 'machine'){
            \DB::table('product_machine')->where('id', $detail_id)->delete();
        }elseif($type == 'material'){
            \DB::table('product_material')->where('id', $detail_id)->delete();
        }
        
        return back()->with('success', 'Product detail has been deleted.');    
    }
    
}
