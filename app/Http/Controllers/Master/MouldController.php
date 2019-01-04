<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MouldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Mould Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Mould'
            ]
        ]; 
        
        $data['moulds'] = \DB::table('mould')->paginate(10);
        
        return view('modules.mould.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Mould";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-mould'),
                'title' => 'Mould'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        return view('modules.mould.create', $data);
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
        
        $insert_id = \DB::table('mould')->insertGetId($data);
        
        if($insert_id){
            
            return back()->with('success', 'Mould has been added.');
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
        $data['page_title'] = "Edit Mould";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-mould'),
                'title' => 'Mould'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['mould'] = \DB::table('mould')->find($id);
        
        return view('modules.mould.edit', $data);
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
        
        $update = \DB::table('mould')->where('id',$id)->update($data);
        
        if($update){
            
            return back()->with('success', 'Mould has been updated.');
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
        $delete = \DB::table('mould')->where('id',$id)->delete();
        if($delete){
            return back()->with('success', 'Mould has been deleted.');
        }
        return back()->with('error', 'Oooppss, something wrong.');
    }
}
