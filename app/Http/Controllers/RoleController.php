<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\Role\CreateRole;
use App\Actions\Role\UpdateRole;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\RoleFormRequest;
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


        $roles = Role::with('permissions')->latest()->get();

        //return  $roles;
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           $permissions = Permission::all();
        // $permission_groups = User::getPermissionGroup();

        return view('role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function storesssss(Request $request)
    // {
    //     // CreateRole::create($request);


    //     //return $request->all();

    //     $role = Role::create(['name' => $request->name, 'guard_name'=>'web']);

    //     //dd($request->permissions);
    //     $role->givePermissionTo($request->permissions);

    //     dd($role);
    //    //$role->syncPermissions($request->permissions);


    //     session()->flash('success', 'Role Created!');
    //     return redirect()->route('roles.index');
    // }






    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name'=>'web']);
    
        // Assuming $request->permission is an array of permission names or identifiers
        // $permissions = [];
        // foreach ($request->permissions as $permissionName) {
        //     $permission = Permission::where('name', $permissionName)->first();
        //     if ($permission) {
        //         $permissions[] = $permission;
        //     }
        // }
    
        // $role->syncPermissions($permissions);

        $permissions = [];
        $post_permissions = $request->input('permissions');
        // dd($post_permissions);
        foreach ($post_permissions as $key => $val) {
            $permissions[intval($val)] = intval($val);
        }
        $role->syncPermissions($permissions);

        //dd($role);
    
        session()->flash('success', 'Role Created..!!');
        return redirect()->route('roles.index');
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

        return view('role.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update($request, $id)
    // {
    //     abort_if(!userCan('role.update'), 403);

    //     try {
    //         UpdateRole::update($request, $role);

    //         Toastr::success('success', 'Role Updated!');
    //         return back();
    //     } catch (\Throwable $th) {

    //         Toastr::error('Error', 'Something is wrong');
    //         return back();
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     abort_if(!userCan('role.delete'), 403);

    //     try {
    //         if (!is_null($role)) {
    //             $role->delete();
    //         }

    //         Toastr::success('success', 'Role Deleted!');
    //         return back();
    //     } catch (\Throwable $th) {
    //         Toastr::error('Error', 'Something is wrong');
    //         return back();
    //     }
    // }
}
