<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
class RolController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:roles.create')->only(['create','store']);
        $this->middleware('permission:roles.index')->only(['index']);
    $this->middleware('permission:roles.edit')->only(['edit','update']);
       $this ->middleware('permission:roles.show')->only(['show']);
        $this->middleware('permission:roles.destroy')->only(['destroy']);
    }
  public function index()
    {
        $roles = Role::paginate();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.edit', $role->id)
            ->with('info', 'Rol guardado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $permissions = Permission::get();

        return view('roles.edit', compact('role', 'permissions'));
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
        $role = Role::find($id);
        $role->update($request->all());

        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.edit', $role->id)
            ->with('info', 'Rol guardado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
