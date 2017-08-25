<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::paginate(15);
        return view('admin.role.index', compact('roles'));
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
        return view('admin.role.item', compact('create'));
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
            'role_name' => 'required|alpha',
            'role_display_name' => 'required',
            'role_description' => 'required',
            ]);
        $role = new Role();
        $role->name = $request->get('role_name');
        $role->display_name = $request->get('role_display_name');
        $role->description = $request->get('role_description');
        if ($role->save()) {
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
        $role = Role::find($id);
        return view('admin.role.item', compact('create', 'role'));
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
            'role_display_name' => 'required',
            'role_description' => 'required',
            ]);
        $role = Role::find($id);
        $role->display_name = $request->get('role_display_name');
        $role->description = $request->get('role_description');
        if ($role->save()) {
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
        $role = Role::find($id);
        if ($role->delete()) {
            return $this->successReturn(trans('common.delete_success'));
        }
        return $this->errorReturn(trans('common.delete_fail'));
    }

    /**
    * role permission
    *
    * @return \Illuminate\View\View
    */
    public function getPermission($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('admin.role.permission', compact('role', 'permissions'));
    }

    /**
    * post save role permissions
    *
    * @return \Illuminate\Http\RedirectResponse
    */
    public function postPermission(Request $request, $id)
    {
        try {
            $role = Role::find($id);
            $this->validate($request, [
                'perms' => 'array'
            ]);
            $role->savePermissions($request->get('perms'));
            if ($role->save()) {
                return Response::json(['status' => 1, 'msg' => trans('common.save_success')]);
            }
            return Response::json(['status' => 0, 'msg' => trans('common.save_fail')]);
        } catch (Exception $e) {
            return Response::json(['status' => 0, 'msg' => trans('common.save_fail')]);
        }
    }
}
