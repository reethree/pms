<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Customer Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Customer'
            ]
        ]; 
        
        $data['customers'] = \DB::table('customer')->paginate(10);
        
        return view('modules.customer.index', $data);
    }

    public function getTable()
    {
        $customers = \DB::table('customer')->select(['id', 'name', 'phone', 'address', 'status']);
        return \Datatables::of($customers)
                ->addColumn('action', function ($customer) {
                    return '<a href="'.route('edit-customer', $customer->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>'
                    . '&nbsp;<a href="'.route('delete-customer', $customer->id).'" onclick="if(!confirm(\'Are you sure want to delete?\')){return false;}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                })
                ->editColumn('status', function ($customer) {
                    return ucfirst($customer->status);
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
        $data['page_title'] = "Create Customer";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-customer'),
                'title' => 'Customer'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        return view('modules.customer.create', $data);
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
        
        $insert_id = \DB::table('customer')->insertGetId($data);
        
        if($insert_id){
            
            return back()->with('success', 'Customer has been added.');
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
        $data['page_title'] = "Edit Customer";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-customer'),
                'title' => 'Customer'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['customer'] = \DB::table('customer')->find($id);
        
        return view('modules.customer.edit', $data);
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
        
        $update = \DB::table('customer')->where('id',$id)->update($data);
        
        if($update){
            
            return back()->with('success', 'Customer has been updated.');
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
        $delete = \DB::table('customer')->where('id',$id)->delete();
        if($delete){
            return back()->with('success', 'Customer has been deleted.');
        }
        return back()->with('error', 'Oooppss, something wrong.');
    }
}
