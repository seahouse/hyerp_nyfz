<?php

namespace App\Http\Controllers\System;

use App\Models\System\Permission;
use App\Models\System\Role;
use App\Models\System\RolePermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RolepermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($roleId)
    {
        //
        $rolepermissions = RolePermission::where('role_id', $roleId)->paginate(10);
        return view('system.rolepermissions.index', compact('rolepermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($roleId)
    {
        //
        $role = Role::findOrFail($roleId);
        $permissionIds = RolePermission::where('role_id', $roleId)->select('permission_id')->get();
        $permissionList = Permission::whereNotIn('id', $permissionIds)->pluck('name', 'id');
//        $permissionList = Permission::whereNotIn('id', $permissionIds)->select('id', DB::raw('concat(name, \' - \', display_name) as name'))->lists('name', 'id');        // for pgsql
        if ($role != null)
            return view('system.rolepermissions.create', compact('role', 'permissionList'));
        else
            return '无此角色';
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
        $role = Role::findOrFail($request->input('role_id'));
        $permission = Permission::findOrFail($request->input('permission_id'));
        if ($role != null && $permission != null)
        {
//             $role->attachPermission($permission);   // another method
            // $role->perms()->sync(array($permission->id));

            $rolepermission = new RolePermission;
            $rolepermission->permission_id = $permission->id;
            $rolepermission->role_id = $role->id;
            $rolepermission->save();
        }

        return redirect('system/roles/' . $request->input('role_id') . '/permissions');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($roleId, $permissionId)
    {
        //
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);
        if ($role != null && $permission != null)
        {
//            $role->detachPermission($permission);
            $deletedRows = RolePermission::where('role_id', $roleId)->where('permission_id', $permissionId)->delete();
        }
        else
            back();

        return redirect('system/roles/' . $roleId . '/permissions');
    }
}
