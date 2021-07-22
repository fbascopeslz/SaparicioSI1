<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Validator;
use saparicio\User;
use saparicio\cargo;
use saparicio\persona;
use saparicio\empleado;
use Illuminate\Support\Facades\Redirect;
use Caffeinated\Shinobi\Models\Permission;
use saparicio\Http\Requests;
use Illuminate\Support\Facades\Input;
use DB;
use saparicio\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
class UserController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:personal.user.create')->only(['create','store']);
        $this->middleware('permission:personal.user.index')->only(['index']);
    $this->middleware('permission:personal.user.edit')->only(['edit','update']);
       $this ->middleware('permission:personal.user.show')->only(['show']);
        $this->middleware('permission:personal.user.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {   if ($request){
            $query=trim($request->get('searchText'));
            $users=DB::table('empleado as e')
           ->join('users as u','e.ci','=','u.ci')
            ->join('cargo as c','e.idCargo','=','c.idCargo')
            ->join('persona as pe','e.ci','=','pe.ci')
            //->select('e.codigo','u.name','c.cargo','u.email','pe.telefono')
            ->select('e.codigo','pe.nombre','pe.paterno','c.cargo','e.codigo','pe.telefono','e.idCargo as idcar','e.ci','u.email','u.id')
            
            ->where('pe.nombre','LIKE','%'.$query.'%')

           // ->where('estado','=','1')
            ->orderBy('e.ci','asc')
            ->paginate(7); 
            //  $users = User::paginate();

            return view('personal.user.index',["users"=>$users,"searchText"=>$query]);   
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $cargos = DB::table('cargo')->get();
       return view("personal.user.create",['cargos'=>$cargos]);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $reglas=[  'password' => 'required|min:8',
                 'email' => 'required|email|unique:users',
                 'ci'=>'required|unique:Empleado' ];
        
    $mensajes=[  'password.min' => 'El password debe tener al menos 8 caracteres',
                 'email.unique' => 'El email ya se encuentra registrado en la base de datos',
                 'ci.unique' => 'La CI ya se encuentra registrado en la base de datos', ];
    $validator = Validator::make( $request->all(),$reglas,$mensajes );
   if( $validator->fails() ){ 
           return back()->with("info","...Existen errores...")->withErrors($validator->errors());   
      //  return view("personal.users.index")->with("info","...Existen errores...")
        //                                   ->withErrors($validator->errors());         
    }
    $persona= new Persona;
    $persona->ci=$request->get('ci');
    $persona->nombre=$request->get('nombre');
    $persona->paterno=$request->get('paterno');
    $persona->materno=$request->get('materno');
    $persona->telefono=$request->get('telefono');
    $persona->sexo=$request->get('sexo');
    $persona->save();


    $usuario=new User;
    $usuario->name=strtoupper( $request->input("nombre").' '.$request->input("paterno").' '.$request->input("materno")) ;
   // $usuario->nombres=strtoupper( $request->input("nombres") ) ;
   // $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
   // $usuario->telefono=$request->input("telefono");
    $usuario->email=$request->input("email");
    $usuario->password= bcrypt( $request->input("password") );    
    $usuario->ci = $request->get('ci');
    $usuario->save();

    $empleado= new Empleado;
    $empleado->ci=$request->get('ci');
    //$empleado->id=$usuario->get('id');
    $empleado->codigo=$request->get('codigo');
    $empleado->idCargo=$request->get('idcar');
    $empleado->save();
    return Redirect::to('personal/user');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$users = User::find($id);
        return view("personal.user.show",["users"=>Cargo::findOrFail($id)]);   
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $users = DB::table('users')->where('ci','=',$id)->first();
            $persona=Persona::findOrFail($id);
            $empleado=Empleado::findOrFail($id);
            $cargo= DB::table('cargo')->get();
            return view('personal.user.edit',["users"=>$users,"persona"=>$persona,"empleado"=>$empleado,"cargos"=>$cargo]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $persona= Persona::findOrFail($id);
        //$persona->ci=$request->get('ci');
   //     $persona->nombre=$request->get('nombre');
     //   $persona->paterno=$request->get('paterno');
      //  $persona->materno=$request->get('materno');
        $persona->telefono=$request->get('telefono');
    //    $persona->sexo=$request->get('sexo');
        $persona->update();
       // int $idu=DB::table('users as u')->join('empleado as e','u.ci','=','e.ci')->select('u.id')->where('e.ci','=',$id)->get();
 /*       $usuario=User::findOrFail($id);
        $usuario->name=strtoupper( $request->input("nombre").' '.$request->input("paterno").' '.$request->input("materno")) ;
        $usuario->email=$request->input("email");
        //$usuario->password= bcrypt( $request->input("password") );    
        $usuario->update();
*/
        $empleado= Empleado::findOrFail($id);
        //$empleado->ci=$request->get('ci');
        //$empleado->id=$usuario->get('id');
        $empleado->codigo=$request->get('codigo');
        $empleado->idCargo=$request->get('idcar');
        $empleado->update();
         return Redirect::to('personal/user'); 
        /*return redirect()->route('personal.users', $user->id)
            ->with('info', 'Usuario guardado con éxito');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
/*
        $userid=DB::table('users as us ')
        ->select('us.id')
        ->where('us.ci','=',$id)
        ->first()->id;
        $usuario=User::findOrFail($userid)->delete();*/
         $empleado=Persona::findOrFail($id)->delete();
        $persona=Persona::findOrFail($id)->delete();
       
        return back()->with('info', 'Eliminado correctamente');    }
}
