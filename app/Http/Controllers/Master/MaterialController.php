<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Material Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Material'
            ]
        ]; 
        
        $data['materials'] = \DB::table('materials')->paginate(10);
        
        return view('modules.material.index', $data);
    }
    
    public function getTable()
    {
        $materials = \DB::table('materials');
        return \Datatables::of($materials)
                ->addColumn('action', function ($material) {
                    return '<a href="'.route('edit-material', $material->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>'
                    . '&nbsp;<a href="'.route('delete-material', $material->id).'" onclick="if(!confirm(\'Are you sure want to delete?\')){return false;}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                })
                ->editColumn('price', function ($customer) {
                    return $customer->currency.' '.number_format($customer->price);
                })
                ->editColumn('status', function ($customer) {
                    return ucfirst($customer->status);
                })
                ->make(true);
    }
    
    public function indexGroup()
    {
        $data['page_title'] = "Material Grouping";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Group'
            ]
        ]; 
        
        $data['groups'] = \DB::table('group_category')->paginate(10);
        
        return view('modules.material.index-group', $data);
    }
    
    public function getGroupTable()
    {
        $groups = \DB::table('group_category');
        return \Datatables::of($groups)
                ->addColumn('action', function ($group) {
                    return '<a href="'.route('edit-material-group', $group->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>'
                    . '&nbsp;<a href="'.route('delete-material-group', $group->id).'" onclick="if(!confirm(\'Are you sure want to delete?\')){return false;}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                })
                ->editColumn('price', function ($group) {
                    return number_format($group->price);
                })
                ->editColumn('status', function ($group) {
                    return ucfirst($group->status);
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
        $data['page_title'] = "Create Materials";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-material'),
                'title' => 'Materials'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        $data['types'] = \DB::table('material_type')->get();
        
        return view('modules.material.create', $data);
    }
    
    public function createGroup()
    {
        $data['page_title'] = "Create Material Group";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-material-group'),
                'title' => 'Group'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        $data['materials'] = \DB::table('materials')->get();
        
        return view('modules.material.create-group', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date_price = $request->date_price;
        $data = $request->except(['_token','date_price']);         
        
        $insert_id = \DB::table('materials')->insertGetId($data);
        
        if($insert_id){
            // Insert Price
            $data_price['material_id'] = $insert_id;
            $data_price['currency'] = $data['currency'];
            $data_price['price'] = $data['price'];
            $data_price['date'] = $date_price;
            
            $insert_price = \DB::table('material_price')->insertGetId($data_price);
            if($insert_price){
                return back()->with('success', 'Material has been added.');
            }
            
            return back()->with('error', 'Cannot add Price.');
        }
        
        return back()->withInput();
    }
    
    public function storeGroup(Request $request)
    {
        $data = $request->except(['_token']);         
        
        $insert_id = \DB::table('group_category')->insertGetId($data);
        
        if($insert_id){
            
            return redirect()->route('edit-material-group', $insert_id)->with('success', 'Group has been added.');
        }
        
        return back()->withInput();
    }
    
    public function storeType(Request $request)
    {
        $data = $request->except(['_token']); 
        
        try
        {
            \DB::table('material_type')->insertGetId($data);
        }
        catch (Exception $e)
        {
            return json_encode(array('success' => false, 'message' => 'Something went wrong, please try again later.'));
        }

        return json_encode(array('success' => true, 'message' => 'Material Type successfully saved!', 'data' => $data));
        
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
        $data['page_title'] = "Edit Materials";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-material'),
                'title' => 'Materials'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['material'] = \DB::table('materials')->find($id);
        $data['types'] = \DB::table('material_type')->get();
        $data['histories'] = \DB::table('material_price')->where('material_id', $id)->orderBy('date', 'DESC')->paginate(5);
        
        $charts = \DB::table('material_price')->where('material_id', $id)->orderBy('date', 'DESC')->limit(10)->get();
        
        $dataChart = array();
        foreach ($charts as $chart):
            $dataChart[] = array(
                'y' => $chart->date,
                'price' => $chart->price
            );
        endforeach;

        $data['chart'] = json_encode($dataChart);
        
        return view('modules.material.edit', $data);
    }
    
    public function editGroup($id)
    {
        $data['page_title'] = "Edit Material Group";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-material-group'),
                'title' => 'Group'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['group'] = \DB::table('group_category')->find($id);
        $data['materials'] = \DB::table('materials')->get();
        $data['material_group'] = \DB::table('material_group')
                ->select('material_group.*','materials.name','materials.type','materials.status')
                ->leftjoin('materials', 'materials.id', '=', 'material_group.material_id')
                ->where('group_id', $id)
                ->paginate(10);
        
        return view('modules.material.edit-group', $data);
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
        $date_price = $request->date_price;
        $data = $request->except(['_token','date_price']);        
        
        $update = \DB::table('materials')->where('id', $id)->update($data);
        
        if($update){
            // Insert Price
            $data_price['material_id'] = $id;
            $data_price['currency'] = $data['currency'];
            $data_price['price'] = $data['price'];
            $data_price['date'] = $date_price;
            
            $insert_id = \DB::table('material_price')->insertGetId($data_price);
            
            if($insert_id){
                // Update Group
                $price = $data['price'];
                if($data['currency'] != 'IDR'){
                    $rate = $this->getCurrencyByName($data['currency']);
                    $price = $data['price'] * $rate;
                }
                $update = \DB::table('material_group')->where('material_id', $id)->update(['price' => $price]);
                
                $this->updateAllGroupPrice($id);
                
                return back()->with('success', 'Material has been updated.');
            }
            
            return back()->with('error', 'Cannot Update Price.');
        }
        
        return back()->withInput();
    }

    public function updateGroupDetail(Request $request, $group_id)
    {
        $data = $request->except(['_token']);        
        
        $material = \DB::table('materials')->find($data['material_id']);
        
        $price = $material->price;
        if($material->currency != 'IDR'){
            $rate = $this->getCurrencyByName($material->currency);
            $price = $material->price * $rate;
        }
        
        $data['group_id'] = $group_id;
        $data['currency'] = 'IDR';
        $data['price'] = $price;
        $insert_id = \DB::table('material_group')->insertGetId($data);
        
        if($insert_id){   
            
            // Calculate per Kg
            $this->updateGroupPrice($group_id);

            return back()->with('success', 'Material has been added.');            
        }
        
        return back()->with('error', 'Ooops, something wrong please try again.');
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
    
    public function destroyGroupDetail($detail_id)
    {
        $material_group = \DB::table('material_group')->where('id', $detail_id)->first();
        
        // Delete Material
        \DB::table('material_group')->where('id', $detail_id)->delete();
        
        // Calculate per Kg
        $this->updateGroupPrice($material_group->group_id);
        
        return back()->with('success', 'Material has been deleted.');    
    }
    
    public function loadGroupMaterial(Request $request, $product_id)
    {
        $group_id = $request->group_id;
        $material_group = \DB::table('material_group')->where('group_id', $group_id)->get();
        
        $data = array();
        foreach ($material_group as $mg):
            $data[] = array(
                'product_id' => $product_id,
                'material_id' => $mg->material_id,
                'packing' => 'Kg',
                'qty' => $mg->weight,
                'cost' => $mg->price
            );
        endforeach;
        
        $insert = \DB::table('product_material')->where('product_id', $product_id)->insert($data);
        
        if($insert){
            return back()->with('success', 'Material has been added.'); 
        }
        
        return back()->with('error', 'Ooopps, something wrong.'); 
    }
    
    public function saveGroupMaterial(Request $request, $product_id)
    {       
        $product_material = \DB::table('product_material')->where('product_id', $product_id)->get();
        
        if($request->group_id){
            // Delete Group
            \DB::table('material_group')->where('group_id', $request->group_id)->delete();
            $group_id = $request->group_id;
        }else{
            $group_id = \DB::table('group_category')->insertGetId(array('name'=>$request->new_group_name,'price'=>0));
        }
        
        foreach ($product_material as $pm):
            $material = \DB::table('materials')->find($pm->material_id);
            $price = $material->price;
            if($material->currency != 'IDR'){
                $rate = $this->getCurrencyByName($material->currency);
                $price = $material->price * $rate;
            }

            \DB::table('material_group')->insertGetId(
                array(
                    'group_id' => $group_id,
                    'material_id' => $pm->material_id,
                    'price' => $price,
                    'currency' => 'IDR',
                    'weight' => $pm->qty
                )
            );
        endforeach;
        
        // Update Product
//        \DB::table('products')->where('id',$request->product_id)->update(array('material_group_id' => $group_id));

        $this->updateGroupPrice($group_id);
        
        return back()->with('success', 'Material Group has been Saved.'); 
        
//        return back()->with('success', 'Material ID not found.'); 
//        return json_encode(array('success' => false, 'msg' => 'Material ID not found.'));
        
    }
}
