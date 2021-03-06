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
        
        $data['machine'] = \DB::table('machines')->count();
        $data['mould'] = \DB::table('mould')->count();
        $data['material'] = \DB::table('materials')->count();
        $data['product'] = \DB::table('products')->count();
        
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
    
    public function indexNice()
    {
        $data['page_title'] = "NICE Data";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'NICE Data'
            ]
        ]; 
        
        return view('modules.nice.index', $data);
    }
    
    public function getTableNice()
    {
        $contacts = \DB::table('contact')->select('*');
        return \Datatables::of($contacts)
                ->addColumn('action', function ($contact) {
                    return '<a href="'.route('edit-customer', $contact->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>'
                    . '&nbsp;<a href="'.route('delete-customer', $contact->id).'" onclick="if(!confirm(\'Are you sure want to delete?\')){return false;}" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
                })
                ->make(true);
    }
    
    public function contact()
    {
        return view('contact');
    }
    
    public function postContact(Request $request)
    {
        $data = $request->except(['_token']);        
        
        $data['target_harga'] = str_replace(',', '', $data['target_harga']);

        $insert_id = \DB::table('contact')->insertGetId($data);

        if($insert_id){
            $data['id'] = $insert_id;
            \Mail::send('contact_email', $data, function($message) {
                $message->from('ppms@polimerindo.com', 'P-PMS');
                $message->to('nice@polimerindo.com','Polimerindo')->subject('NICE Form');
            });
            
            return back()->with('success', 'Contact Customer has been added.');
        }
        
        return back()->withInput()->with('error', 'Oopps, something wrong. Please try again.');
    }
    
    public function editContact($id)
    {
        $contact = \DB::table('contact')->find($id);
        
        return view('edit-contact',array('contact' => $contact));
    }
    
    public function updateContact(Request $request, $id)
    {
        $data = $request->except(['_token']); 
        
        $data['target_harga'] = str_replace(',', '', $data['target_harga']);

        $update = \DB::table('contact')->where('id', $id)->update($data);

        if($update){
            
            return back()->with('success', 'Contact Customer has been updated.');
        }
        
        return back()->withInput()->with('error', 'Oopps, something wrong. Please try again.');
    }

}
