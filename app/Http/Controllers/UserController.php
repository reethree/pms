<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = "Users Management";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => '',
                'title' => 'Users'
            ]
        ]; 
        $data['users'] = \DB::table('users')->paginate(10);
        
        return view('modules.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Create Users";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-users'),
                'title' => 'Users'
            ],
            [
                'action' => '',
                'title' => 'Create'
            ]
        ]; 
        
        return view('modules.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'unique:users|email',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
//            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token','password_confirmation']);        
        $data['password'] = bcrypt($request->password);
        
        $insert_id = \DB::table('users')->insertGetId($data);
        
        if($insert_id){
//            $user = \DB::table('users')->find($insert_id);
//            $user->roles()->attach($request->role_id);
            
            return back()->with('success', 'Data user has been added.');
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
        $data['page_title'] = "Edit Users";
        $data['page_description'] = "";
        $data['breadcrumbs'] = [
            [
                'action' => route('index-users'),
                'title' => 'Users'
            ],
            [
                'action' => '',
                'title' => 'Edit'
            ]
        ]; 
        
        $data['user'] = \DB::table('users')->find($id);
        
        return view('modules.users.edit', $data);
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'username' => 'required',
            'password' => 'confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $data = $request->except(['_token','password_confirmation','password']);     
        
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $update = \DB::table('users')->where('id', $id)->update($data);
        
        if($update){
//            $user = \DB::table('users')->find($insert_id);
//            $user->roles()->attach($request->role_id);
            
            return back()->with('success', 'Data user has been updated.');
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
        //
    }
}
