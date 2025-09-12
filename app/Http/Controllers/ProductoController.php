<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Color;
use App\Talla;
use App\Producto;
use App\Modelo;
use App\Proveedor;
use App\Cliente;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductosExport;
use Laracasts\Flash\Flash;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stock=Producto::where('id','LIKE','%'.$request->name.'%')->orderBy('id','desc')->orwhere('nombre','LIKE','%'.$request->name.'%')->orderBy('id','desc')->paginate(15);

        $stock->each(function($stock){
            $stock->color;
            $stock->talla;
            $stock->modelo;
            $stock->proveedor;
        });

        return view('productos/index',compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colores=Color::orderBy('nombre')->select('nombre','id')->get();

        $tallas=Talla::orderBy('nombre')->select('nombre','id')->get();

        $modelos=Modelo::orderBy('nombre')->select('nombre','id')->get();

        $proveedores=Proveedor::orderBy('nombre')->select('nombre','id')->get();

        return view('productos/create',compact('colores','tallas','modelos', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'id'    => 'required|unique:productos,id',
        ],
        [
            'id.unique' => 'Ya existe un producto con ese ID'
        ]);
        
        $productos=Producto::create($request->all());

        return redirect()->route('productos.index');
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
        $productos=Producto::find($id);
        $colores=Color::orderBy('nombre')->select('nombre','id')->get();

        $tallas=Talla::orderBy('nombre')->select('nombre','id')->get();

        $modelos=Modelo::orderBy('nombre')->select('nombre','id')->get();

        $proveedores=Proveedor::orderBy('nombre')->select('nombre','id')->get();
        
        $productos->proveedor;
        $productos->color;
        $productos->medida;
        $productos->modelo;
        return view('productos/edit', compact('productos', 'colores', 'tallas', 'modelos', 'proveedores'));
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
        $productos=Producto::find($id);
        $productos->update(
            ['nombre'=>$request->nombre,'cantidad'=>$request->cantidad, 'p_compra'=>$request->p_compra, 'p_venta'=>$request->p_venta]);
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto=Producto::find($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }

    public function showPdf(){
    /*
        $stock=Producto::all();
        $stock->each(function($stock){
            $stock->color;
            $stock->talla;
            $stock->modelo;
        });

        $pdf = PDF::loadView('pdf.stock', compact('stock'));
        return $pdf->stream('stock.pdf');*/
        return Excel::download(new ProductosExport, 'listado_productos.xlsx');
    }

    public function searchProducto(Request $request){

        $data = request()->validate([
            'codigoProducto'    => 'required|string|exists:productos,id'

        ],
        [
            'codigoProducto.exists' => 'El código no esta asociado a ningun producto'
        ]);

        $producto = Producto::find($request->codigoProducto);
        $producto->color;
        $producto->talla;
        $producto->modelo;

        return response()->json(compact('producto'),200);
    }

    public function searchCliente(Request $request){

        $data = request()->validate([
            'codigoCliente'    => 'required|string|exists:clientes,id'

        ],
        [
            'codigoCliente.exists' => 'El código no esta asociado a ningun cliente'
        ]);

        $cliente = Cliente::find($request->codigoCliente);

        return response()->json(compact('cliente'),200);
    }
}
