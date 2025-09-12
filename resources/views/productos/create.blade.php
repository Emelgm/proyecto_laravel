@extends('../plantillas/main')

@section('titulo')
    Nuevo Producto
@endsection

@section('nav')
    <div class="container" align="center">
        <header class="container h1 t1" align="center">Agregar Producto</header>
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
<div class="container" align="center">
	<form action="{{route('productos.store')}}" method="post" enctype="multipart/form-data"><br>
		@csrf
		<div class="col-md-6">
			<input type="text" class="form-control" name="id" placeholder="Referencia" required><br>
			<input type="text" class="form-control" name="nombre" placeholder="Nombre de Producto" required><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5">Categoría</label>
				</div>
				<div class="col">
					<select class="form-control" name="id_color">
						@foreach($colores as $col)
						<option class="text-left" value="{{ $col->id }}">{{ $col->nombre }}</option>
						@endforeach
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5">Marca</label>
				</div>
				<div class="col">
					<select class="form-control" name="id_talla">
						@foreach($tallas as $med)
						<option class="text-left" value="{{ $med->id }}">{{ $med->nombre }}</option>
						@endforeach
					</select><br>
				</div>
			</div>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5">Modelo</label>
				</div>
				<div class="col">
					<select class="form-control" name="id_modelo">
						@foreach($modelos as $prod)
						<option class="text-left" value="{{ $prod->id }}">{{ $prod->nombre }}</option>
						@endforeach
					</select><br>
				</div>
			</div>
			<input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5">Proveedor</label>
				</div>
				<div class="col">
					<select class="form-control" name="id_proveedor">
						@foreach($proveedores as $prod)
						<option class="text-left" value="{{ $prod->id }}">{{ $prod->nombre }}</option>
						@endforeach
					</select><br>
				</div>
			</div>
			<input type="text" class="form-control" name="p_compra" placeholder="Precio de compra" required><br>
			<input type="text" class="form-control" name="p_venta" placeholder="Precio de venta" required><br>
			<input type="submit" class="btn btn-otro" name="registrar" value="Registrar">
		</div><br>
	</form>
</div><br><br>
@endsection