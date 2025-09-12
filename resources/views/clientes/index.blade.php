@extends('../plantillas/main')

@section('titulo')
	Asociados
@endsection

@section('nav')
<div class="container" align="center">
	<header class="container h1 t1" align="center">Listado de Asociados</header>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('categorias.index') }}">Insumos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('clientes.index') }}">Asociados</a>
		</li>
	</ul>
</div>
@endsection

@section('contenido')
<div class="container"><br>
	<div class="row">
		<div class="col-md-6 table-responsive">
		<form action="">
			<fieldset>
				<legend class="h5"><strong>Usuarios </strong><a type="button" class="btn btn-secondary" href="{{ route('register') }}">Nuevo <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg></a></legend>
				<table id="tabla" class="table table-sm">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>E-mail</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $emp)
						<tr>
							<td>{{ $emp->name }}</td>
							<td>{{ $emp->email }}</td>
							<td>
							<form action="{{ route('usuarios.destroy',$emp->id) }}" method="POST" accept-charset="utf-8">
							@csrf
							@method('DELETE')
							<button onclick="return confirm('Esta seguro de eliminar el producto?')" type="submit" class="btn btn-danger" title="Eliminar">Eliminar
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  							<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
								</svg>
							</button>
							</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</fieldset>
		</form>
	</div>
	</div><hr>
	<div class="row">
	<div class="col-md-6 table-responsive">
		<form action="">
			<fieldset >
				<legend class="h5"><strong>Clientes </strong><a type="button" class="btn btn-secondary" href="{{ route('clientes.create') }}">Nuevo <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg></a></legend>
				<table id="tabla" class="table table-sm">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Telefono</th>
							<th colspan="2">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($clientes as $cl)
						<tr>
							<td>{{ $cl->id }}</td>
							<td>{{ $cl->nombres }}</td>
							<td>{{ $cl->apellidos }}</td>
							<td>{{ $cl->telefono }}</td>
							<td>
							<form action="{{ route('clientes.destroy',$cl->id) }}" method="POST" accept-charset="utf-8"><a class="btn btn-primary" title="Editar" href="{{ route('clientes.edit',$cl->id) }}">Editar 
									<svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg>
						</a>
							@csrf
							@method('DELETE')
							<button onclick="return confirm('Esta seguro de eliminar el producto?')" type="submit" class="btn btn-danger" title="Eliminar">Eliminar
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  							<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
								</svg>
							</button>
							</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</fieldset>
		</form>
	</div>
	<div class="table-responsive col-md-6">
		<fieldset>
				<legend class="h5"><strong>Proveedores </strong><a type="button" class="btn btn-secondary" href="{{ route('proveedores.create') }}">Nuevo <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg></a></legend>
	<table id="tabla" class="table table-sm">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Telefono</th>
			<th>E-mail</th>
			<th colspan="2">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($proveedores as $prov)
			<tr>
				<td>{{ $prov->nombre }}</td>
				<td>{{ $prov->telefono }}</td>
				<td>{{ $prov->email }}</td>
					<td>
					<form action="{{ route('proveedores.destroy',$prov->id) }}" method="POST" accept-charset="utf-8"><a class="btn btn-primary" title="Editar" href="{{ route('proveedores.edit',$prov->id) }}">Editar 
									<svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg>
						</a>
						@csrf
						@method('DELETE')
						<button onclick="return confirm('Esta seguro de eliminar el producto?')" type="submit" class="btn btn-danger" title="Eliminar">Eliminar
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  							<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
							</svg>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
	</tbody>
	</table>
			</fieldset>
		</form>
	</div>
	</div>
	<center>
		<div>{{ $clientes->links() }}</div>
	</center>
</div><br><br>
@endsection