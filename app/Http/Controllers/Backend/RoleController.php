<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroup();
        Session()->flash('success', 'Role hase been created !!');
        return view('backend.pages.roles.create', compact('permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate Data
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ], [
            'name.required' => "Please give a role name"
        ]);


        // Process Data
        $role = Role::create(['name' =>  $request->name]);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return back();
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
        $role = Role::findById($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroup();

        $countPermissions =  Permission::count();
        $countPermissionGroups = User::getpermissionGroup()->count();


        return view('backend.pages.roles.edit', compact("role", 'permissions', 'permission_groups', 'countPermissions', 'countPermissionGroups'));
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
        // Validate Data
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $id,
        ], [
            'name.required' => "Please give a role name"
        ]);


        // Process Data
        $role = Role::findById($id);
        $role->name = $request->name;
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        $role->save();
        Session()->flash('success', 'Role hase been updated !!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::table('roles')->where('id', $id)->delete();

        Role::destroy($id); // with destroy() method.
        Session()->flash('success', 'Role hase been deleted !!');

        return redirect()->back();
    }
}
