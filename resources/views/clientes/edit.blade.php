@extends('../plantillas/main')

@section('titulo')
    Editar Cliente
@endsection

@section('nav')
    <div class="container" align="center">
        <header class="container h1 t1" align="center">Editar Cliente</header>
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
                <a class="nav-link active" href="{{ route('clientes.index') }}">Asociados/Cliente</a>
            </li>
        </ul>
    </div>
@endsection

@section('contenido')
<div class="container" align="center">
	<form action="{{route('clientes.update',$cliente->id)}}" method="post" enctype="multipart/form-data"><br>
		@csrf 
		@method('PUT')
		<div class="col-md-6">
			<div class="row">
				<div class="col col-md-3">
					<label class="h5"><em>Documento</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $cliente->id }}</label>
				</div>
			</div><br>	
			<div class="row">
				<div class="col col-md-3">
					<label class="h5"><em>Nombres</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $cliente->nombres }}</label>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-3">
					<label class="h5"><em>Apellidos</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $cliente->apellidos }}</label>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-3">
					<label class="h5"><em><strong>Teléfono</strong></em></label>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="telefono" value="{{ $cliente->telefono }}" placeholder="Número de Teléfono o Celular" required><br>
				</div>
			</div><br>
			<input type="submit" class="btn btn-otro" name="registrar" value="Actualizar">
		</div><br>
	</form>
</div><br><br>
@endsection