@extends('../plantillas/main')

@section('titulo')
	Detalle de venta
@endsection

@section('nav')
<div class="container" align="center">
	<header class="container h1 t1" align="center">Detalle de venta</header>
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
<div class="container " style="width: 55%"><br>
	<div class="row h6" style="">
			<div class="col">
					<img src="{{asset('img/logo.png')}}"  alt="logo" width="220" height="100">
			</div>
			<div class="col text-right">	
					Papelería Ximena <br>
					Calle 12 #18-70 La Libertad <br>
					Cúcuta - N.S.
			</div>
	</div><hr>
	<div class="row">
			<div class="col">
					<strong>FACTURACIÓN #{{ $venta->id }}</strong>
			</div>
			<div class="col text-right">	
				@php
					$fecha = date("d-m-Y",strtotime($venta->created_at));
					$p_t = number_format($venta->total,0,',','.');
				@endphp
					Fecha: {{ $fecha }}
			</div>
	</div><br>
	<div class="row">
			<div class="col">
					<strong>{{ $venta->cliente->nombres }} {{ $venta->cliente->apellidos }}</strong><br>
					C.C {{ $venta->cliente->id }}<br>
					Telef: {{ $venta->cliente->telefono }}
			</div>
			<div class="col text-right h2">	
					<strong>TOTAL: {{ $p_t }} COP</strong>
			</div>
	</div>
	<div class="table-responsive p-2 bg-white">
			<div class="h5 text-center"><strong>Detalle de Venta</strong></div>
			<table class="table table-hover table-stripped table-sm">
				<thead>
					<tr>
						<th>PRODUCTO</th>
						<th>CANTIDAD</th>
						<th>ESTADO</th>
						<th>DTO</th>
						<th>PRECIO U</th>
						<th>SUB TOTAL</th>
					</tr>
				</thead>
				<tbody>
				@php
					$total_u=0;
					$total_t=0;
					$dto=0;
					$p_u=0;
					$total_uu=0;
					$total_tt=0;
					$dsc=0;
					$v_r=0;
					$v_rr=0;
					$descu=0;
				@endphp
				@foreach($venta->venta_producto as $vent)
				<tr>
					<td><strong>Nombre:</strong> {{ $vent->productos->nombre }} <br>
					    <strong>Modelo:</strong> {{ $vent->productos->modelo->nombre }} <br>
					<strong>Categoría:</strong> {{ $vent->productos->color->nombre }} <br>
					<strong>Marca:</strong> {{ $vent->productos->talla->nombre }}</td>
					<td>{{ $vent->cantidad }}</td>
					<td>@if($venta->estado)
					<span class="badge">VENTA</span>
					@else
					<span class="badge">ABONO</span>
					@endif</td>
					@php
						$desc=$vent->descuento;
						$p_venta=$vent->p_detalle;
						$p_u=number_format($p_venta,0,',','.');
						$dto=number_format($desc,0,',','.');
						$total_uu = number_format($total_u=($vent->cantidad*$vent->p_detalle)-$vent->descuento,0,',','.');
					@endphp
					<td>{{ $dto }}</td>
					<td>{{ $p_u }}</td>
					<td>{{ $total_uu }}</td>
					@php
						$dsc +=$desc;
						$v_r+=$vent->cantidad*$vent->p_detalle;
						$v_rr=number_format($v_r,0,',','.');
						$total_t+=$total_u;
						$total_tt=number_format($total_t,0,',','.');
						$descu=number_format($dsc,0,',','.');
					@endphp
				</tr>
				@endforeach
				</tbody>
			</table><br>
			<div class="h6 text-right"><strong>VALOR REAL: {{ $v_rr }} COP</strong></div>
			<div class="h6 text-right"><strong>VALOR DTO: {{ $descu }} COP</strong></div>
			<div class="h5 text-right"><strong>TOTAL: {{ $total_tt }} COP</strong></div>
		</div>
</div><br>

<div class="container" style="width: 55%">
<a target="_blank" type="button" class="btn btn-info" onclick="printDiv();" href="{{ route('ventas.showticket', $venta) }}">IMPRIMIR FACTURA</a>
</div><br><br>
@endsection