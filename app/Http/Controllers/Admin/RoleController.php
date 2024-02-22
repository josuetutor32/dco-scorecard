<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderby('role','ASC')
        ->get();
        // ->paginate(2);
        // $functions->setPath('functions');
        return view('admin.roles.list',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'role'       => 'required|unique:roles,role',
          
        ],
            $messages = array('role.required' => 'Role is Required!',
            'role.unique' => 'Duplicate Record found!')
        );
       
        $role = Role::create($request->all());
        return redirect()->back()->with('with_success', 'Role : ' . strtoupper($role->role) .' created succesfully!'); 
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

        $this->validate($request,
        [
            'role'       => 'required|unique:roles,role',
          
        ],
            $messages = array('role.required' => 'Role is Required!',
            'role.unique' => 'Duplicate Record found!')
        );

        $role = Role::findorfail($id);
        $role->update(['role' => $request['role']]);

       return redirect()->back()->with('with_success', strtoupper($role->role) .' was Updated succesfully!');   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findorfail($id);
        $role->delete();
        return redirect()->back()->with('with_success', strtoupper($role->role) .' was Deleted succesfully!');   
    }
}
