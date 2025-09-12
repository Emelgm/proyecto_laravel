@extends('../plantillas/main')

@section('titulo')
    Nuevo Cliente
@endsection

@section('nav')
    <div class="container" align="center">
        <header class="container h1 t1" align="center">Agregar Cliente</header>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
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
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('clientes.index') }}">Asociados/Cliente</a>
            </li>
        </ul>
    </div>
@endsection

@section('contenido')
<div class="container" align="center">
    <form action="{{route('clientes.store')}}" method="post" enctype="multipart/form-data"><br>
        @csrf
        <div class="col-md-6">
            <div class="row">
                <div class="col col-md-3">
                    <label class="h5">Documento</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="id" placeholder="Documento" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col col-md-3">
                    <label class="h5">Nombres</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="nombres" placeholder="Primer y segundo nombre" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col col-md-3">
                    <label class="h5">Apellidos</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="apellidos" placeholder="Primer y segundo apellido" required>
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
            <input type="submit" class="btn btn-otro" name="registrar" value="Registrar">
        </div><br>
    </form>
</div><br><br>
@endsection