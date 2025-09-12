@extends('../plantillas/main')

@section('titulo')
    Editar Producto
@endsection

@section('nav')
    <div class="container" align="center">
        <header class="container h1 t1" align="center">Editar Producto</header>
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
	<form action="{{route('productos.update',$productos->id)}}" method="post" enctype="multipart/form-data"><br>
		@csrf 
		@method('PUT')
		<div class="col-md-6">
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em>Referencia</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $productos->id }}</label>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em><strong>Nombre</strong></em></label>
				</div>
				<div class="col">
				<input type="text" class="form-control" name="nombre" placeholder="Nombre Producto" value="{{ $productos->nombre }}" required><br>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em>Modelo</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $productos->modelo->nombre }}</label>
				</div>
			</div><br>	
			
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em>Color</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $productos->color->nombre }}</label>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em>Talla</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $productos->talla->nombre }}</label>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em><strong>Cantidad</strong></em></label>
				</div>
				<div class="col">
				<input type="number" class="form-control" name="cantidad" placeholder="Cantidad" value="{{ $productos->cantidad }}" required><br>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em>Proveedor</em></label>
				</div>
				<div class="col">
					<label class="form-control">{{ $productos->proveedor->nombre }}</label>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em><strong>Precio de Compra</strong></em></label>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="p_compra" value="{{ $productos->p_compra }}" placeholder="Precio de compra" required><br>
				</div>
			</div><br>
			<div class="row">
				<div class="col col-md-2">
					<label class="h5"><em><strong>Precio de Venta</strong></em></label>
				</div>
				<div class="col">
					<input type="text" class="form-control" name="p_venta" value="{{ $productos->p_venta }}" placeholder="Precio de venta" required><br>
				</div>
			</div><br>
			<input type="submit" class="btn btn-otro" name="registrar" value="Actualizar">
		</div><br>
	</form>
</div><br><br>
@endsection