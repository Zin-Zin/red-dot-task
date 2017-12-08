<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionFormRequest;
use App\Models\Permission;
use App\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles
        return view('permissions.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionFormRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        if ($request->roles <> '') {
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value);
                $role->permissions()->attach($permission);
            }
        }
        return redirect()->route('permissions.index')
            ->with('status','Permission added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionFormRequest $request, Permission $permission)
    {
        $permission->name=$request->name;
        $permission->save();
        return redirect()->route('permissions.index')
            ->with('status', 'Permission '. $permission->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')
            ->with('status', 'Permission deleted successfully!');
    }
}
