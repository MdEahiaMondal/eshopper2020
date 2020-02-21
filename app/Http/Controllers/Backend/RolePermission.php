<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RolePermission extends Controller
{

    public function index()
    {
       $admins = Admin::all();
       return view('backend.role_permission.index', compact('admins'));
    }


    public function create()
    {
        return view('backend.role_permission.create');
    }


    public function store(Request $request)
    {
        $request['password'] = md5($request->password);
        Admin::create($request->all());
        return redirect()->back()->with('success', 'User Role Create Done !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('backend.role_permission.edit', compact('admin'));
    }


    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        return redirect()->back()->with('success', 'User Role Updated Done !');
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
