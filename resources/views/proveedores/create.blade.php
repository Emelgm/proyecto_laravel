@extends('../plantillas/main')

@section('titulo')
    Nuevo Proveedor
@endsection

@section('nav')
    <div class="container" align="center">
        <header class="container h1 t1" align="center">Agregar Proveedor</header>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('colores.index') }}">Insumos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('clientes.index') }}">Asociados/Proveedor</a>
            </li>
        </ul>
    </div>
@endsection

@section('contenido')
<div class="container" align="center">
    <form action="{{route('proveedores.store')}}" method="post" enctype="multipart/form-data"><br>
        @csrf
        <div class="col-md-6">
            <div class="row">
                <div class="col col-md-3">
                    <label class="h5">Nombre</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col col-md-3">
                    <label class="h5">Teléfono</label>
                </div>
                <div class="col">
                    <input type="numeric" class="form-control" name="telefono" placeholder="Número de Teléfono o Celular" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col col-md-3">
                    <label class="h5">Email</label>
                </div>
                <div class="col">
                    <input type="email" class="form-control" name="email" placeholder="Correo Electrónico" required>
                </div>
            </div><br>
            <input type="submit" class="btn btn-otro" name="registrar" value="Registrar">
        </div><br>
    </form>
</div><br><br>
@endsection