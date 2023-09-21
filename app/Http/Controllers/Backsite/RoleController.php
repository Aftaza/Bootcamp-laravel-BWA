<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// Library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

// model
use App\Models\ManagementAcces\Permission;
use App\Models\ManagementAcces\PermissionRole;
use App\Models\ManagementAcces\Role;
use App\Models\ManagementAcces\RoleUser;

use Auth;


class RoleController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
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
        $role = Role::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.management-access.role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->all();

        $role = Role::create($data);

        // response with alert
        alert()->success('Success Created', 'Successfully added new role with id '.$role->id);
        
        return redirect()->route('backsite.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role->load('permission');

        return view('pages.backsite.management-access.role.index', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permission = Permission::all();
        $role->load('permission');

        return view('pages.backsite.management-access.role.index', compact('role', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permission()->sync($request->input('permission', []));

        // response with alert
        alert()->success('Success Updated', 'Successfully update role with id '.$role->id);
        
        return redirect()->route('backsite.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->forceDelete();

        // response with alert
        alert()->success('Success Deleted', 'Successfully Deleted role with id '.$role->id);
        
        return back();
    }
}
