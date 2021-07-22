<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();

Route::get('/home', 'HomeController@index');

//Producto
/*Route::middleware(['auth'])->group(function(){
	//Roles
	//Roles
	/*Route::post('roles/store', 'RoleController@store')->name('roles.store')
		->middleware('permission:roles.create');

	Route::get('roles', 'RoleController@index')->name('roles.index')
		->middleware('permission:roles.index');

	Route::get('roles/create', 'RoleController@create')->name('roles.create')
		->middleware('permission:roles.create');

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
		->middleware('permission:roles.edit');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
		->middleware('permission:roles.show');

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
		->middleware('permission:roles.destroy');

	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
		->middleware('permission:roles.edit');
	//Users
	Route::get('users', 'UserController@index')->name('users.index')
		->middleware('permission:users.index');

	Route::put('users/{user}', 'UserController@update')->name('users.update')
		->middleware('permission:users.edit');

	Route::get('users/{user}', 'UserController@show')->name('users.show')
		->middleware('permission:users.show');

	Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
		->middleware('permission:users.destroy');

	Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
		->middleware('permission:users.edit');*/

		//saboress
	/*Route::post('almacen/sabor/store', 'SaborController@store')->name('sabor.store')
		->middleware('permission:sabor.create');

	Route::get('almacen/sabor', 'SaborController@index')->name('sabor.index')
		->middleware('permission:sabor.index');

	Route::get('almacen/sabor/create', 'SaborController@create')->name('sabor.create')
		->middleware('permission:sabor.create');

	Route::put('almacen/sabor/{sabor}', 'SaborController@update')->name('sabor.update')
		->middleware('permission:sabor.edit');

	Route::get('almacen/sabor/{sabor}', 'SaborController@show')->name('sabor.show')
		->middleware('permission:sabor.show');

	Route::delete('almacen/sabor/{sabor}', 'SaborController@destroy')->name('sabor.destroy')
		->middleware('permission:sabor.destroy');

	Route::get('almacen/sabor/{sabor}/edit', 'SaborController@edit')->name('sabor.edit')
		->middleware('permission:sabor.edit');
});*/
/*Route::middleware(['auth'])->group(function() {
	
});*/

Route::Resource('inventario/almacen','AlmacenController');

Route::Resource('inventario/sabor','SaborController');
Route::Resource('inventario/tipobebida','TipoBebidaController');
Route::Resource('inventario/marca','MarcaController');
Route::Resource('inventario/medida','MedidaController');
Route::Resource('inventario/paquete','PaqueteController');
Route::Resource('inventario/tipoenvase','TipoEnvaseController');

Route::Resource('inventario/producto','ProductoController');
Route::Resource('inventario','InventarioController');

//compras
Route::Resource('compras/proveedor','ProveedorController');
Route::Resource('compras/ingreso','IngresoController');
//Ventas
Route::Resource('ventas/cliente','ClienteController');
Route::Resource('ventas/zona','ZonaController');
Route::Resource('ventas/pedido','PedidoController');
Route::Resource('ventas/entrega','EntregaController');

// USUARIOS
Route::Resource('personal/cargo','CargoController');
Route::Resource('personal/user','UserController');
Route::Resource('roles','RolController');
Route::Resource('users','UsersController');
Route::Resource('personal/zonaempleado','ZonaEmpleadoController');


//reportes
Route::Resource('Reportes','PdfController');
Route::get('crear_reporte_productos/{tipo}', 'PdfController@crear_reporte_producto');
Route::get('crear_reporte_ingresos/{tipo}', 'PdfController@crear_reporte_ingresos');
Route::get('crear_reporte_ingresos_fechas', 'PdfController@crear_reporte_ingresos_fechas');
Route::post('crear_reporte_ingresos_fechas_post', 'PdfController@crear_reporte_ingresos_fechas_post');
Route::get('crear_reporte_inventario/{tipo}', 'PdfController@crear_reporte_inventario');
Route::get('crear_reporte_pedidos/{tipo}', 'PdfController@crear_reporte_pedidos');




//Route::get('/{slug?}', 'HomeController@index');