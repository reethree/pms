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
        
        $charts = \DB::table('electricity')->orderBy('month','asc')->orderBy('year','desc')->limit(12)->get();
        
        $dataChart = array();
        foreach ($charts as $chart):
            $dataChart[] = array(
                'y' => $chart->year.'-'.$chart->month,
                'bill' => $chart->monthly_bill
            );
        endforeach;
        
        $data['electricities'] = \DB::table('electricity')->orderBy('month','asc')->orderBy('year','desc')->paginate(10);
        $data['chart'] = json_encode($dataChart);
        
        return view('modules.electricity.index', $data);
    }
    
    public function getTable()
    {
        $electricities = \DB::table('electricity')->select('*');
        return \Datatables::of($electricities)
                ->addColumn('action', function ($electricity) {
                    return '<a href="'.route('edit-customer', $electricity->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>'
                    . '&nbsp;<a href="'.route('delete-customer', $electricity->id).'" onclick="if(!confirm(\'Are you sure want to delete?\')){return false;}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                })
                ->editColumn('status', function ($electricity) {
                    return ucfirst($electricity->status);
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
        $data['monthly_bill'] = str_replace(',','',$data['monthly_bill']);
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
        $data['monthly_bill'] = str_replace(',','',$data['monthly_bill']);
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
        $order_id = $request->order_id;
        
        $data['max_bill'] = number_format(\DB::table('electricity')->where('year', $year)->max('monthly_bill'));
        $data['min_bill'] = number_format(\DB::table('electricity')->where('year', $year)->min('monthly_bill'));
        $data['avg_bill'] = number_format(\DB::table('electricity')->where('year', $year)->avg('monthly_bill'));
        $data['total_machine'] = \DB::table('machines')->count();
        
        $sum_product_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('quantity');
        $sum_daily_qty = \DB::table('order_product')->where('order_id', $order_id)->sum('daily_qty');
        
        if($sum_daily_qty){
            $data['qty_prod'] = round($sum_product_qty/$sum_daily_qty);
        }else{
            $data['qty_prod'] = 0;
        }
        
        return json_encode($data);
    }
}
