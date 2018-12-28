<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Welcome to Dashboard";
        $data['page_description'] = "This is Admin Page PMS PT. Dinamika Polimerindo";
        
        return view('welcome', $data);
    }
    
    public function indexCurrency()
    {
        $data['page_title'] = "Currency Management";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Currency'
            ]
        ]; 
        $data['currencies'] = \DB::table('currency')->paginate(10);
        
        return view('modules.currency.index', $data);
    }
    
    public function updateCurrency(Request $request)
    {
        $data = $request->except(['_token']);        
        
        $update = \DB::table('currency')->where('id',$request->id)->update($data);
        
        if($update){
            
            return back()->with('success', 'Currency has been updated.');
        }
        
        return back()->with('error', 'Oopps, something wrong.');
    }

}
