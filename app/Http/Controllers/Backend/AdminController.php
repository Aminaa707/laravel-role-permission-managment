<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class  AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view this page');
        }
        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();

        return view('backend.pages.admins.create', compact('roles'));
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
            'name' => 'required|max:50',
            'username' => 'required|max:50|unique:admins',
            'email' => 'required|unique:admins|email',
            'password' => 'required|min:6',
            'confirm_password' => "required | same:password",

        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);

        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        $admin->save();

        Session()->flash('success', 'Admin hase been created !!');
        return  redirect()->route('admin.admins.index');
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view this page');
        }
        $admin = Admin::find($id);
        $roles = Role::all();


        return view('backend.pages.admins.edit', compact("admin", 'roles'));
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view this page');
        }
        // Validate Data
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:50|unique:admins',
            'email' => 'required|max:255|unique:admins,email,' . $id,
            'password' => 'nullable|min:6',
            'confirm_password' => ['nullable', 'required_with:password', 'same:password'],
        ]);

        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($admin->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->roles()->detach();
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        $admin->save();
        Session()->flash('success', 'Admin hase been updated !!');

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
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view this page');
        }
        // DB::table('Admins')->where('id', $id)->delete();

        Admin::destroy($id); // with destroy() method.
        Session()->flash('success', 'Admin hase been deleted !!');

        return redirect()->back();
    }
}
