@extends('../plantillas/main')

@section('titulo')
	Editar venta
@endsection

@section('nav')
<div class="container" align="center">
	<header class="container h1 t1" align="center">Editar venta</header>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('ventas.index') }}">Ventas</a>
		</li>
		@can(!'has.role:vendedor')
		<li class="nav-item">
			<a class="nav-link" href="{{ route('categorias.index') }}">Insumos</a>
		</li>
		@endcan
		@can(!'has.role:vendedor')
		<li class="nav-item">
			<a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
		</li>
		@endcan
		@can(!'has.role:vendedor')
		<li class="nav-item">
			<a class="nav-link" href="{{ route('clientes.index') }}">Asociados</a>
		</li>
		@endcan
	</ul>
</div>
@endsection

@section('contenido')

<div class="container mt-4 mb-5 text-center">
	
<!--AQUI VA EL FORMULARIO DE LOS DATOS DE LA VENTA-->
<form action="{{ route('clientes.edit',$venta->id) }}">
	<div class="row">
		<div class="col col-md-1" align="center">
			<strong>Cliente: </strong>
		</div>
		<div class="col col-md-2" align="center">
			<label class="form-control">{{ $venta->cliente->id }}</label>
		</div>
		<div class="col col-md-1">
			<strong>Nombre: </strong>
		</div>
		<div class="col col-md-4">
			<label class="form-control">{{ $venta->cliente->nombres }} {{ $venta->cliente->apellidos }}</label>
		</div>
		<div class="col col-md-1">
			<strong>Total: </strong>
		</div>
		@php
			$t_p=$venta->total;
			$v_total=number_format($t_p,0,',','.');
		@endphp
		<div class="col col-md-2">
			<label class="form-control">{{ $v_total }}</label>
		</div>
	</div>
</form><br>

@if($venta->estado == 0 || $venta->estado == 2 || count($venta->abonos) > 0)
<h4 class="header mb-2">ABONOS DE LA VENTA</h4><br>
@if($venta->estado == 0 || $venta->estado == 2)
<form action="{{ route('ventas.agregarAbonoVenta') }}" method="POST">
	@csrf
	<div class="row col-md-8">
		<div class="form-group col-6">
			<input type="hidden" value="{{ $venta->id }}" name="venta_id">
			<input required="" v-model="valorAbonoVenta" v-on:keyup="validarAbonoVentaEdit" type="number" name="valor_abono" class="form-control" placeholder="Valor del abono">
		</div>
		<div class="form-group col-4">
			<button type="submit" class="btn btn-otro" :disabled="valorAbonoVenta <= 0">AGREGAR ABONO</button>
		</div>
	</div>
</form>
@else
<div class="alert alert-info">
	<strong>La venta ha pasado a estado completado el {{ $venta->abonos[count($venta->abonos) - 1]->created_at }}</strong>
</div>
@endif
<table class="table table-striped">
	<thead>
		<tr>
			<th>VALOR ABONO</th>
			<th>EMPLEADO</th>
			<th>FECHA</th>
		</tr>
	</thead>
	<tbody>
		@php
			$totalVenta = 0;
		@endphp
		@foreach($venta->abonos as $abono)
		@php
			$t_p=$abono->valor;
			$a_total=number_format($t_p,0,',','.');
		@endphp
		<tr>
			<td>{{ $a_total }}</td>
			<td>{{ $abono->empleado->name }}</td>
			<td>{{ $abono->created_at }}</td>
		</tr>
		@php
			$totalVenta += $abono->valor;
		@endphp
		@endforeach
		@php
			$rest= $venta->total-$totalVenta;
			$r_total=number_format($rest,0,',','.');
		@endphp
	</tbody>
</table>
<div class="h6 text-right"><strong>DEUDA RESTANTE: {{ $r_total }} COP</strong></div>

@endif

</div>

@endsection
@section('actionUrlJs')
<script>
	var action = 'editVentas';
	@if(isset($totalVenta)) var totalVenta = {{ $venta->total - $totalVenta }}; @endif
</script>
@endsection