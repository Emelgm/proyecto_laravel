@extends('../plantillas/main')

@section('titulo')
    Nuevo Color
@endsection

@section('nav')
    <div class="container" align="center">
        <header class="container h1 t1" align="center">Agregar Categoría</header>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('categorias.index') }}">Insumos/Categoría</a>
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
<div class="container" align="center">
    <form action="{{route('categorias.store')}}" method="post" enctype="multipart/form-data"><br>
        @csrf
        <div class="col-md-6">
            <div class="row">
                <div class="col col-md-3">
                    <label class="h5">Categoría</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre de la Categoría" required>
                </div>
            </div><br>
            <input type="submit" class="btn btn-otro" name="registrar" value="Registrar">
        </div><br>
    </form>
</div><br><br>
@endsection