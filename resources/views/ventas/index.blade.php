@extends('../plantillas/main')

@section('titulo')
	Ventas
@endsection

@section('nav')
<div class="container" align="center">
	<header class="container h1 t1" align="center">Listado de ventas</header>
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
<div class="container"><br>
	<div class="row">
		<div class="col">
			<form action="{{ route('ventas.index') }}">
				<label class="h4">Buscar por fecha</label>
				<hr>
				<div class="form-row">
					<div class="col">
					<label class="h4">Del:</label>
					</div>
					<div class="col">
						<input type="date" class="form-control" name="buscar_d" value="{{ Request::get('buscar_d') }}" required>
					</div>
					<div class="col">
					<label class="h4">A:</label>
					</div>
					<div class="col">
						<input type="date" class="form-control" name="buscar_h" value="{{ Request::get('buscar_h') }}" required>
					</div><button type="submit" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
		  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
		</svg></button>
				</div>
			</form>
		</div>
		<div class="col">
			<form action="" style="text-align: right;">
				<label class="h4" >Buscar por Cliente</label>
				<hr>
				<div class="form-row">
					<div class="col" style="text-align: right;">
					<label class="h4">Código:</label>
					</div>
					<div class="col">
						<input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Cédula del Cliente" required>
					</div>
					<button type="submit" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
					  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
					</svg>
					</button>
				</div>
			</form>
		</div>
	</div>
			@if($buscar_d && $buscar_h)<br>
			<div class="alert alert-primary h6" role="alert">
				Los resultados para la fecha <strong>{{ $buscar_d }}</strong> hasta <strong>{{ $buscar_h }}</strong> son:
			</div>
			@endif
			@if(Request::get('name'))<br>
			<div class="alert alert-primary h6" role="alert">
				Los resultados para el código <strong>{{ Request::get('name') }}</strong> es:
			</div>
			@endif
	<div class="table-responsive" align="center"><br>
		<div class="row">
			<div class="col text-left">
				<a type="button" class="btn btn-secondary" href="{{ route('ventas.create') }}">Nueva Venta <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
			  	<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
			  	<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
				</svg></a>
			</div>
			@if($buscar_h && $buscar_d)
			<div class="col h4">
				@php
					$total_f=0;
				@endphp
				@foreach($venta as $vent)
				@php
					$total_f+=$vent->total;
				@endphp
				@endforeach
				@php
					$total=number_format($total_f,0,',','.');
				@endphp
				<strong>TOTAL: {{ $total }} COP</strong>
			</div>
			@endif
		</div><br>
	<table id="tabla" class="table table-sm">
	<thead>
		<tr>
			<th>Referencia</th>
			<th>Cliente</th>
			<th>Empleado a cargo</th>
			<th>Total</th>
			<th>Estado</th>
			<th>Fecha</th>
			<th colspan="3">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($venta as $vent)
			<tr>
				<td>{{ $vent->id }}</td>
				<td>{{ $vent->cliente->nombres }} {{ $vent->cliente->apellidos }}</td>
				<td>{{ $vent->user->name }}</td>
				@php
					$t_p=$vent->total;
					$p_total=number_format($t_p,0,',','.');
					$fecha = date("d-m-Y",strtotime($vent->created_at));
				@endphp
				<td>{{ $p_total }}</td>
				<td>
					@if($vent->estado == 1)
					<span class="badge badge-success">VENTA</span>
					@elseif($vent->estado == 0)
					<span class="badge badge-warning">ABONO</span>
					@elseif($vent->estado == 2)
					<span class="badge badge-info">FIADO</span>
					@endif
				</td>
				<td>{{ $fecha }}</td><!--
				<td>
					<a href="{{ route('ventas.edit',$vent->id) }}" class="btn btn-warning">Editar<svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg></a>
				</td>-->
					<td>
					@can(!'has.role:vendedor')
					<form action="{{ route('ventas.destroy',$vent->id) }}" method="POST" accept-charset="utf-8">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger" title="Eliminar" type="submit">Eliminar
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  							<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
							</svg>
						</button>
					</form>
					@endcan
					<a class="btn btn-secondary" title="Editar" href="{{ route('ventas.show',$vent->id) }}">Detalle 
									<svg class="bi bi-file-earmark-text" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z"/>
								<path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z"/>
								<path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
							</svg>
						</a>
					</td>
			</tr>
			@endforeach
	</tbody>
</table><br>
</div>
	<center>
		<div>{{ $venta->links() }}</div>
	</center>
</div><br><br>
@endsection