<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Machine Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Machine'
            ]
        ]; 
        
//        $data['machines'] = \DB::table('machines')->paginate(10);
        
        return view('modules.machine.index', $data);
    }
    
    public function getTable()
    {
        $machines = \DB::table('machines');
        return \Datatables::of($machines)
                ->addColumn('action', function ($machine) {
                    return '<a href="'.route('edit-machine', $machine->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>'
                    . '&nbsp;<a href="'.route('delete-machine', $machine->id).'" onclick="if(!confirm(\'Are you sure want to delete?\')){return false;}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                })
                ->addColumn('image', function ($machine) {
                    return '<img src="https://www.hollisterwhitney.com/wp-content/uploads/2018/02/1-Overhead-Traction-Machine-510px.png" width="120" />';
                })
                ->editColumn('depreciation', function ($machine) {
                    if($machine->depreciation == true){
                        return 'Yes';
                    }else{
                        return 'No';
                    }
                })
                ->editColumn('price', function ($machine) {
                    return number_format($machine->price);
                })
                ->editColumn('status', function ($machine) {
                    return ucfirst($machine->status);
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Machines";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-machine'),
                'title' => 'Machines'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        return view('modules.machine.create', $data);
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
        if(!isset($data['depreciation'])){
            $data['depreciation'] = 0;
        }
        $insert_id = \DB::table('machines')->insertGetId($data);
        
        if($insert_id){
            
            return back()->with('success', 'Machine has been added.');
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
        $data['page_title'] = "Edit Machines";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-machine'),
                'title' => 'Machines'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['machine'] = \DB::table('machines')->find($id);
        
        return view('modules.machine.edit', $data);
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
        if(!isset($data['depreciation'])){
            $data['depreciation'] = 0;
        }
        $update = \DB::table('machines')->where('id',$id)->update($data);
        
        if($update){
            
            return back()->with('success', 'Machine has been updated.');
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
        $delete = \DB::table('machines')->where('id',$id)->delete();
        if($delete){
            return back()->with('success', 'Machine has been deleted.');
        }
        return back()->with('error', 'Oooppss, something wrong.');
    }
}
