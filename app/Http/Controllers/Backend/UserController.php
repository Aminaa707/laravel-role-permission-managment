<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class  UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('backend.pages.users.create', compact('roles'));
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
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'confirm_password' => "required | same:password",

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $user->save();

        Session()->flash('success', 'User hase been created !!');
        return  redirect()->route('admin.users.index');
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
        $users = User::find($id);
        $roles = Role::all();


        return view('backend.pages.users.edit', compact("users", 'roles'));
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
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'confirm_password' => ['nullable', 'required_with:password', 'same:password'],
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->password) {
            $user->password = Hash::make($request->password);
        }

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $user->save();
        Session()->flash('success', 'User hase been updated !!');

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
        // DB::table('users')->where('id', $id)->delete();

        User::destroy($id); // with destroy() method.
        Session()->flash('success', 'User hase been deleted !!');

        return redirect()->back();
    }
}
