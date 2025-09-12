@extends('../plantillas/main')

@section('titulo')
	Productos
@endsection

@section('nav')
<div class="container" align="center">
	<header class="container h1 t1" align="center">Listado de Productos</header>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('categorias.index') }}">Insumos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="{{ route('productos.index') }}">Productos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('clientes.index') }}">Asociados</a>
		</li>
	</ul>
</div>
@endsection

@section('contenido')
<div class="container"><br>
	<form action="{{ route('productos.index') }}">
		<div class="form-row">
			<div class="col col-md-2">
				<label class="h4">Buscar Producto:</label>
			</div>
			<div class="col col-md-2">
				<input type="text" value="{{ Request::get('name') }}" class="form-control" name="name" placeholder="Código de Producto" required>
			</div><button type="submit" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></button>
		</div>
	</form>
	{{--
	@if(Request::get('name'))<br>
	<div class="alert alert-primary h6" role="alert">
		Los resultados para el color <strong>{{ Request::get('name') }}</strong> son:
	</div>
	@endif --}}<br>
	<a type="button" class="btn btn-secondary" href="{{ route('productos.create') }}">Nuevo <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
</svg></a>
	<a type="button" class="btn btn-otro" href="{{ route('stock.showPdf') }}">Imprimir Stock <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
  <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
  <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
</svg></a>
	<div class="table-responsive" align="center"><br>
	<table id="tabla" class="table table-sm">
	<thead>
		<tr>
			<th>Referencia</th>
			<th>Producto</th>
			<th>Modelo</th>
			<th>Categoría</th>
			<th>Marca</th>
			<th>Cantidad</th>
			<th>Proveedor</th>
			<th>Precio Compra</th>
			<th>Precio Venta</th>
			<th colspan="2">Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($stock as $st)
			<tr>
				<td>{{ $st->id }}</td>
				<td>{{ $st->nombre }}</td>
				<td>{{ $st->modelo->nombre }}</td>
				<td>{{ $st->color->nombre }}</td>
				<td>{{ $st->talla->nombre }}</td>
				<td>{{ $st->cantidad }}</td>
				<td>{{ $st->proveedor->nombre }}</td>
				<td>{{ $st->p_compra }}</td>
				<td>{{ $st->p_venta }}</td>
					<td>
					<form action="{{ route('productos.destroy',$st->id) }}" method="POST" accept-charset="utf-8">
						<a class="btn btn-primary" title="Editar" href="{{ route('productos.edit',$st->id) }}">Editar 
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
	</div>
	<center>
		<div>{{ 
		    $stock->appends(Request::all())->links("pagination::bootstrap-4")}}
		</div>
	</center><br>
</div><br><br>
@endsection