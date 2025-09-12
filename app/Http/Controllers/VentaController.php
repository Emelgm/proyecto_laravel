<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Venta;
use App\Producto;
use App\Cliente;
use App\User;
use App\VentaProducto;
use Illuminate\Support\Facades\Auth;
use App\AbonoVenta;

class VentaController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $desde=null;
        $hasta=null;
        if(!empty($request->buscar_d) && !empty($request->buscar_h)){
             $desde = date("Y-m-d 00:00:00", strtotime($request->buscar_d));
             $hasta = date("Y-m-d 23:59:59", strtotime($request->buscar_h));
            $venta=Venta::whereBetween('created_at',[$desde,$hasta])->orderBy('id','desc')->paginate(10);
            
            $venta->each(function($venta){
            $venta->user;
            $venta->cliente;
        });
        }else{
            $venta=Venta::whereHas('cliente',function($q) use($request){
                    $q->where('id','LIKE','%'.$request->name.'%');
                })->orderBy('id','desc')->paginate(10);
        }

        return view('ventas/index')->with(['venta'=>$venta,'buscar_d'=>$desde,'buscar_h'=>$hasta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {        
        $bventa=Producto::where('nombre','LIKE','%'.$request->name.'%')->orderBy('id','asc')->orwhere('id','LIKE','%'.$request->name.'%')->orderBy('id','asc')->get();



        $clientes=Cliente::orderBy('nombres')->select('nombres','id')->get();
       
        $stock=Producto::all();
        //return $productos;
        //return collect(['a'=>['color'=>'cristal','medidas'=>'LAM 1.28x2.5 LISA 2.5 mm'],'string'=>['color'=>'cristal','medidas'=>'LAM 1.28x2.5 LISA 2.5 mm'] ])->groupBy('color');
        return view('ventas/create')->with(['bventa'=>$bventa, 'stock'=>$stock, 'clientes'=>$clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$estado = (!empty($request->estado)) ? 0 : 1;
        $venta=Venta::create([
            'id_empleado'=> Auth::user()->id,
            'id_cliente'=>$request->id_cliente,
            'total'=>0,
            'estado'=> $request->estado
        ]);
        $total=0;
        $i=0;
        foreach ($request->productos as $item) {
            $productos=Producto::find($item);
            $productos->cantidad = $productos->cantidad - $request->input('cantidad_venta')[$i];
            $productos->save();
            $venta_producto=VentaProducto::create([
                'cantidad'=>$request->input('cantidad_venta')[$i],
                'id_venta'=>$venta->id,
                'id_producto'=>$item,
                'p_detalle'=>$productos->p_venta,
                'descuento'=>$request->input('descuentos')[$i],
            ]);
            $i++;
            $total+=($productos->p_venta*$venta_producto->cantidad)-$venta_producto->descuento;
        }

        if($request->estado == 0){ 
            $abono_venta = AbonoVenta::create([
                    'venta_id'      => $venta->id,
                    'valor'         => $request->valor_abono,
                    'cliente_id'    => $request->id_cliente,
                    'empleado_id'   => auth()->user()->id
            ]);
        }

        $venta->total=$total;
        $venta->save();

        return redirect()->route('ventas.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta=Venta::find($id);
        $venta->venta_producto->each(function($venta_producto) {
            $venta_producto->productos->modelo;
            $venta_producto->productos->talla;
            $venta_producto->productos->color;
        });

        return view('ventas/show')->with('venta',$venta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
       $venta->cliente;
        $venta->abonos->each(function($abonos){
            $abonos->empleado;
        });
       
        return view('ventas.edit',compact('venta'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta=Venta::find($id);
        $venta->delete();
        return redirect()->route('ventas.index');
    }

    public function showticket(Venta $venta){

        $venta->productos;
        $venta->cliente;
        $venta->venta_producto;

        $pdf = PDF::loadView('pdf.ticket', compact('venta'));
        return $pdf->setPaper('b7', 'portrait')->stream('ticket.pdf');

    }

    public function get_stock(Request $request){

        $stock=Producto::orderBy('id','asc')->get();

        $stock->each(function($stock){
            $stock->colorVenta;
            $stock->tallaVenta;
            $stock->modeloVenta;
        });

        return response()->json(compact('stock'),200);
    }

    public function agregarAbonoVenta(Request $request){

        $data = request()->validate([
            'venta_id'    => 'required|integer|exists:ventas,id',
            'valor_abono' => 'required|integer'
        ],
        [
            'venta_id.exists' => 'El ID no esta asociado a ninguna venta'
        ]);

        $venta = Venta::where('id',$request->venta_id)->first();
        $venta->abonos;

        $totalAbonos = 0;
        foreach($venta->abonos as $abono){
            $totalAbonos += $abono->valor;
        }

        if($request->valor_abono > ($venta->total - $totalAbonos)){
            return redirect()->route('ventas.edit',$venta->id);
        }

        $abono_venta = AbonoVenta::create([
            'venta_id'      => $request->venta_id,
            'valor'         => $request->valor_abono,
            'empleado_id'   => auth()->user()->id
        ]);

        $venta = Venta::where('id',$request->venta_id)->first();
        $venta->abonos;

        $totalAbonos = 0;
        foreach($venta->abonos as $abono){
            $totalAbonos += $abono->valor;
        }

        if($totalAbonos >= $venta->total){
            $venta->estado = 1;
            $venta->save();
        }

        return redirect()->route('ventas.edit',$venta->id);
    }
}
