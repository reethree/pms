<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ElectricityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Electricity Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Electricity'
            ]
        ]; 
        
        $charts = \DB::table('electricity')->where('year', date('Y'))->get();
        
        $dataChart = array();
        foreach ($charts as $chart):
            $dataChart[] = array(
                'y' => $chart->year.'-'.$chart->month,
                'bill' => $chart->monthly_bill
            );
        endforeach;
        
        $data['electricities'] = \DB::table('electricity')->orderBy('month','asc')->paginate(10);
        $data['chart'] = json_encode($dataChart);
        
        return view('modules.electricity.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Electricity";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-electricity'),
                'title' => 'Electricity'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        return view('modules.electricity.create', $data);
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
        
        $insert_id = \DB::table('electricity')->insertGetId($data);
        
        if($insert_id){
            
            return back()->with('success', 'Electricity has been added.');
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
        $data['page_title'] = "Edit Electricity";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-electricity'),
                'title' => 'Electricity'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['electricity'] = \DB::table('electricity')->find($id);

        return view('modules.electricity.edit', $data);
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
        
        $update = \DB::table('electricity')->where('id',$id)->update($data);
        
        if($update){
            
            return back()->with('success', 'Electricity has been updated.');
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
        $delete = \DB::table('electricity')->where('id',$id)->delete();
        if($delete){
            return back()->with('success', 'Electricity has been deleted.');
        }
        return back()->with('error', 'Oooppss, something wrong.');
    }
    
    public function getDataElectricityByYear(Request $request)
    {
        $year = $request->year;
        
        $data['max_bill'] = number_format(\DB::table('electricity')->where('year', $year)->max('monthly_bill'));
        $data['min_bill'] = number_format(\DB::table('electricity')->where('year', $year)->min('monthly_bill'));
        $data['avg_bill'] = number_format(\DB::table('electricity')->where('year', $year)->avg('monthly_bill'));
        
        return json_encode($data);
    }
}
