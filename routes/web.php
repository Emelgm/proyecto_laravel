<?php

use Illuminate\Support\Facades\Route;
use App\User;

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
/*Route::get('/registro',function(){
	User::create(["name"=>'admin', "email"=>'admin@gmail.com', "password"=>bcrypt('admin')]);
});*/
Route::post('/searchProducto','ProductoController@searchProducto');
Route::post('/searchCliente','ProductoController@searchCliente');
Route::middleware(['auth'])->group(function(){
	
	Route::get('/', 'VentaController@create')->middleware('permission:ventas.create');
	Route::get('get_stock','VentaController@get_stock');
	//permisos de ventas
	Route::get('ventas','VentaController@index')->name('ventas.index')->middleware('permission:ventas.index');
	Route::get('ventas/create','VentaController@create')->name('ventas.create')->middleware('permission:ventas.create');
	Route::post('ventas/store','VentaController@store')->name('ventas.store')->middleware('permission:ventas.create');
	Route::get('ventas/{venta}/edit','VentaController@edit')->name('ventas.edit')->middleware('permission:ventas.edit');
	Route::put('ventas/update','VentaController@update')->name('ventas.update')->middleware('permission:ventas.edit');
	Route::get('ventas/{venta}','VentaController@show')->name('ventas.show')->middleware('permission:ventas.show');
	Route::delete('ventas/{venta}','VentaController@destroy')->name('ventas.destroy')->middleware('permission:ventas.destroy');
	//permisos de clientes
	Route::get('clientes', 'ClienteController@index')->name('clientes.index')->middleware('permission:asociados');
	Route::get('clientes/create', 'ClienteController@create')->name('clientes.create')->middleware('permission:clientes');
	Route::post('clientes/store', 'ClienteController@store')->name('clientes.store')->middleware('permission:clientes');
	Route::get('clientes/{cliente}/edit', 'ClienteController@edit')->name('clientes.edit')->middleware('permission:asociados');
	Route::put('clientes/update', 'ClienteController@update')->name('clientes.update')->middleware('permission:asociados');
	Route::delete('clientes/{cliente}', 'ClienteController@destroy')->name('clientes.destroy')->middleware('permission:asociados');
	//permisos insumos
	Route::resource('categorias', 'ColorController')->middleware('permission:insumos');
	Route::resource('tallas', 'TallaController')->middleware('permission:insumos');
	Route::resource('modelos', 'ModeloController')->middleware('permission:insumos');
	//permisos producots y asociados
	Route::resource('productos', 'ProductoController')->middleware('permission:insumos');
	Route::resource('usuarios', 'UsuarioController')->middleware('permission:insumos');
	Route::resource('proveedores', 'ProveedorController')->middleware('permission:insumos');
	Route::get('showPdf','ProductoController@showPdf')->name('stock.showPdf');
	Route::get('venta/showticket/{venta}','VentaController@showticket')->name('ventas.showticket');
	Route::post('ventas/agregarAbonoVenta','VentaController@agregarAbonoVenta')->name('ventas.agregarAbonoVenta');
});

Auth::routes();