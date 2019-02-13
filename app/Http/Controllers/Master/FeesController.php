<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Management Fees Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Management Fees'
            ]
        ]; 
        
        $data['fees'] = \DB::table('management_fees')->paginate(10);
        
        return view('modules.fees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Fee";
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
        
        return view('modules.fees.create', $data);
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
        $data['monthly_revenue'] = str_replace(',', '', $data['monthly_revenue']);
        $insert_id = \DB::table('management_fees')->insertGetId($data);
        
        if($insert_id){
            
            return back()->with('success', 'Fees has been added.');
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
    
    public function getDataOverheadByYear(Request $request)
    {
        $year = $request->year;
        
        $data['min'] = number_format(\DB::table('management_fees')->where('year', $year)->max('monthly_revenue'));
        $data['max'] = number_format(\DB::table('management_fees')->where('year', $year)->min('monthly_revenue'));
        $data['avg'] = number_format(\DB::table('management_fees')->where('year', $year)->avg('monthly_revenue'));
        
        return json_encode($data);
    }
}
