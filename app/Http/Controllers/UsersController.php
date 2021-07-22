<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use saparicio\User;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
   
   public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:users.create')->only(['create','store']);
        $this->middleware('permission:users.index')->only(['index']);
    $this->middleware('permission:users.edit')->only(['edit','update']);
       $this ->middleware('permission:users.show')->only(['show']);
        $this->middleware('permission:users.destroy')->only(['destroy']);
    }
    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();

        return view('users.edit', compact('user', 'roles'));
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
        $user = User::find($id);
        $user->update($request->all());

        $user->roles()->sync($request->get('roles'));
        return Redirect::to('users/'.$user->id)->with('info', 'Usuario guardado con éxito');
        //return redirect()->route('users.edit', $user->id)
          //  ->with('info', 'Usuario guardado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}

