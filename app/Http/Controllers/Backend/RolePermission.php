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
        if ($request->type == 'admin')
        {
            $request['product_all_access'] = 1;
            $request['product_edit_access'] = 1;
            $request['product_view_access'] = 1;
            $request['product_delete_access'] = 1;
            $request['category_access'] = 1;
            $request['order_access'] = 1;
            $request['coupon_access'] = 1;
        }
        if ( $request->product_all_access)
        {
            $request['product_all_access'] = 1;
            $request['product_create_access'] = 1;
            $request['product_edit_access'] = 1;
            $request['product_view_access'] = 1;
            $request['product_delete_access'] = 1;
        }

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

        if ($request->type == 'admin')
        {
            $request['product_all_access'] = 1;
            $request['product_create_access'] = 1;
            $request['product_edit_access'] = 1;
            $request['product_view_access'] = 1;
            $request['product_delete_access'] = 1;
            $request['category_access'] = 1;
            $request['order_access'] = 1;
            $request['coupon_access'] = 1;
        }else{
            if ($request->product_all_access)
            {
                $request['product_edit_access'] = 1;
                $request['product_create_access'] = 1;
                $request['product_view_access'] = 1;
                $request['product_delete_access'] = 1;
                $request['product_all_access'] = 1;
            }else
                {
                    $request['product_edit_access'] = $request->product_edit_access ?? 0;
                    $request['product_create_access'] = $request->product_create_access ?? 0;
                    $request['product_view_access'] = $request->product_view_access ?? 0;
                    $request['product_delete_access'] = $request->product_delete_access ?? 0;
                }
            $request['category_access'] = $request->category_access ?? 0;
            $request['order_access'] = $request->order_access ?? 0;
            $request['coupon_access'] = $request->coupon_access ?? 0;

        }
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
