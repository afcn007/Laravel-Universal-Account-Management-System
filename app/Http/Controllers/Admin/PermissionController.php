<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::paginate(15);
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $create = true;
        return view('admin.permission.item', compact('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'permission_name' => 'required|alpha',
            'permission_display_name' => 'required',
            'permission_description' => 'required',
            ]);
        $permission = new Permission();
        $permission->name = $request->get('permission_name');
        $permission->display_name = $request->get('permission_display_name');
        $permission->description = $request->get('permission_description');
        if ($permission->save()) {
            return $this->successReturn(trans('common.add_success'));
        }
        return $this->errorReturn(trans('common.add_fail'));
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
        $create = false;
        $permission = Permission::find($id);
        return view('admin.permission.item', compact('create', 'permission'));
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
        //
        $this->validate($request, [
            'permission_display_name' => 'required',
            'permission_description' => 'required',
            ]);
        $permission = Permission::find($id);
        $permission->display_name = $request->get('permission_display_name');
        $permission->description = $request->get('permission_description');
        if ($permission->save()) {
            return $this->successReturn(trans('common.edit_success'));
        }
        return $this->errorReturn(trans('common.edit_fail'));
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
        $permission = Permission::find($id);
        if ($permission->delete()) {
            return $this->successReturn(trans('common.delete_success'));
        }
        return $this->errorReturn(trans('common.delete_fail'));
    }
}
