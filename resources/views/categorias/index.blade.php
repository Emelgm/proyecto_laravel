@extends('../plantillas/main')

@section('titulo')
	Insumos
@endsection

@section('nav')
<div class="container" align="center">
	<header class="container h1 t1" align="center">Listado de Insumos</header>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('categorias.index') }}">Insumos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('clientes.index') }}">Asociados</a>
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
				<legend class="h5"><strong>Categorías </strong><a type="button" class="btn btn-secondary" href="{{ route('categorias.create') }}">Nuevo <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></a></legend>
				<table id="tabla" class="table table-sm">
					<thead>
						<tr>
							<th>Nombre</th>
							<th width="150">Acción</th>
						</tr>
					</thead>
					<tbody>
						@foreach($colores as $col)
						<tr>
							<td>{{ $col->nombre }}</td>
							<td>
							<form action="{{ route('categorias.destroy',$col->id) }}" method="POST" accept-charset="utf-8">
							@csrf
							@method('DELETE')
							<button onclick="return confirm('Esta seguro de eliminar el color?')" type="submit" class="btn btn-danger" title="Eliminar">Eliminar
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
	<div class="col-md-6 table-responsive">
		<form action="">
			<fieldset>
				<legend class="h5"><strong>Marcas </strong><a type="button" class="btn btn-secondary" href="{{ route('tallas.create') }}">Nueva <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></a></legend>
				<table id="tabla" class="table table-sm">
					<thead>
						<tr>
							<th>Número</th>
							<th width="150">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tallas as $tall)
						<tr>
							<td>{{ $tall->nombre }}</td>
							<td>
							<form action="{{ route('tallas.destroy',$tall->id) }}" method="POST" accept-charset="utf-8">
							@csrf
							@method('DELETE')
							<button onclick="return confirm('Esta seguro de eliminar la talla?')" type="submit" class="btn btn-danger" title="Eliminar">Eliminar
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
	<div class="table-responsive col-md-6">
		<fieldset>
				<legend class="h5"><strong>Modelos </strong><a type="button" class="btn btn-secondary" href="{{ route('modelos.create') }}">Nuevo <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></a></legend>
	<table id="tabla" class="table table-sm">
	<thead>
		<tr>
			<th>Nombre</th>
			<th width="150">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($modelos as $mod)
			<tr>
				<td>{{ $mod->nombre }}</td>
					<td>
					<form action="{{ route('modelos.destroy',$mod->id) }}" method="POST" accept-charset="utf-8">
						@csrf
						@method('DELETE')
						<button onclick="return confirm('Esta seguro de eliminar el modelo?')" type="submit" class="btn btn-danger" title="Eliminar">Eliminar
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
		<div>{{ $colores->links() }}</div>
	</center>
</div><br><br>
@endsection