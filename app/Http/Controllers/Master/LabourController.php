<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Labour Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Labour'
            ]
        ]; 
        
        $charts = \DB::table('labour')->orderBy('month','asc')->orderBy('year','desc')->limit(12)->get();
        
        $dataChart = array();
        foreach ($charts as $chart):
            $dataChart[] = array(
                'y' => $chart->year.'-'.$chart->month,
                'employee' => $chart->number_of_employee,
                'wages' => $chart->weekly_wages/1000000
            );
        endforeach;
        
        $data['labours'] = \DB::table('labour')->orderBy('month','asc')->orderBy('year','desc')->paginate(10);
        $data['chart'] = json_encode($dataChart);
        
        return view('modules.labour.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Labour";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-labour'),
                'title' => 'Labour'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        return view('modules.labour.create', $data);
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
        
        $insert_id = \DB::table('labour')->insertGetId($data);
        
        if($insert_id){
            
            return back()->with('success', 'Labour has been added.');
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
        $data['page_title'] = "Edit Labour";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-labour'),
                'title' => 'Labour'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['labour'] = \DB::table('labour')->find($id);

        return view('modules.labour.edit', $data);
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
        
        $update = \DB::table('labour')->where('id',$id)->update($data);
        
        if($update){
            
            return back()->with('success', 'Labour has been updated.');
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
        $delete = \DB::table('labour')->where('id',$id)->delete();
        if($delete){
            return back()->with('success', 'Labour has been deleted.');
        }
        return back()->with('error', 'Oooppss, something wrong.');
    }
    
    public function getDataLabourByYear(Request $request)
    {
        $year = $request->year;
        $order_id = $request->order_id;
        
        $sum_product_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('quantity');
        $sum_daily_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('daily_qty');
        
        $labours = \DB::table('labour')->where('year', $year)->get();
        $data['sum_employee'] = 0;$data['sum_wages'] = 0;$data['avg_labour'] = 0;$data['shift_labour'] = 0;
        foreach ($labours as $labour):
            $data['sum_employee'] += $labour->number_of_employee;
            $data['sum_wages'] += $labour->weekly_wages;
        endforeach;
        
        if($data['sum_wages'] > 0):
            // cost per month
            $monthly = $data['sum_wages']/count($labours);
            $head = $data['sum_wages'] / $data['sum_employee'];
            
            $data['cost_monthly'] = number_format($monthly);
            // cost per head
            $data['avg_labour'] = number_format(round($data['sum_wages'] / $data['sum_employee']));        
            // cost per day
            $data['shift_labour'] = number_format(round($monthly/25));
            // cost head per day
            $data['cost_head_day'] = number_format(round($head/25));
            // Qty Prod
            if($sum_daily_qty){
                $data['qty_prod'] = round($sum_product_qty/$sum_daily_qty);
            }else{
                $data['qty_prod'] = 0;
            }
        endif;
        
        return json_encode($data);
    }
}
