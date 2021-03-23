<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        foreach($admins as $admin)
        {
            $admin->role = $admin->get_role();
        }
        return response()->json($admins, 200);
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
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'string'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
       ]);

       $role = Role::where('name',$request->role)->first();

       $admin->role()->attach($role);

       $admin->role = $admin->get_role();

        return response()->json($admin, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $admin->role = $admin->get_role();
        return response()->json($admin, 200);
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
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|',
            'password' => 'required|min:6',
            'role' => 'required|string'
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password != $request->password)
        {
            $admin->password = Hash::make($request->password);
        }
        if($admin->get_role()->name != $request->role)
        {
            $role = Role::where('name',$admin->get_role()->name)->first();
            $admin->role()->detach($role);

            $roleEdit = Role::where('name',$request->selectrole)->first();
            $admin->role()->attach($roleEdit);
        }
        $admin->save();
        $admin->role = $admin->get_role();

        return response()->json($admin, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $role = Role::where('name',$admin->get_role()->name)->first();
        $admin->role()->detach($role);
        $admin->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
