@extends('../plantillas/main')

@section('titulo')
	Registro de venta
@endsection

@section('contenido')
<div class="container" >
	<div class="container">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link" href="{{ route('ventas.index') }}">Ventas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('clientes.create') }}">Agregar Cliente</a>
			</li>
		</ul>
	</div><br>
	<form action="{{ route('ventas.create') }}">
		<div class="form-row">
			<div class="col col-md-2">
				<label class="h4">Buscar Producto:</label>
			</div>
			<div class="col col-md-2">
				<input type="text" value="{{ Request::get('name') }}" class="form-control" name="name" placeholder="Código o Nombre de Producto" required>
			</div><button type="submit" class="btn btn-otro"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></button>
		</div>
	</form>
	@if(Request::get('name'))<br>
	<div class="alert alert-primary h6" role="alert">
		Los resultados para el color <strong>{{ Request::get('name') }}</strong> son:
	</div>
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
			<th>Precio</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bventa as $st)
			<tr>
				<td>{{ $st->id }}</td>
				<td>{{ $st->nombre }}</td>
				<td>{{ $st->modelo->nombre }}</td>
				<td>{{ $st->color->nombre }}</td>
				<td>{{ $st->talla->nombre }}</td>
				<td>{{ $st->cantidad }}</td>
				<td>{{ $st->p_venta }}</td>
			</tr>
			@endforeach
	</tbody>
	</table>
	</div>
	@endif<br><hr>
	<label class="h1">Registrar Venta</label>
	<div class="row">
		<div class="col">
				<input type="text" class="form-control" v-model="codigoProducto" placeholder="Código de Producto">
		</div>
		<div class="col">
			<button type="button" name="buscar" class="btn btn-otro" v-on:click="searchProducto">Buscar</button>
		</div>
	</div><br>
	<div class="alert alert-info" v-if="productoVenta && productoVenta != ''">
		<p><strong v-html="productoVentaDescripcion"></strong></p>
	</div>
	<Errors :errors="errors"></Errors>
	<form action="{{route('ventas.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
		@csrf
		<div class="row">
			<div class="col-md-6">
				<div class="col">
						<label v-if="productoVenta" class="h4 text-danger">Cantidad existente: <span  class="font-weight-bold" v-text="productoVenta.cantidad"></span></label>
						<br>
						<label class="h4">Cantidad a vender</label>
				</div>
				<div class="col">
					<input type="number" class="form-control" name="cantidad" placeholder="Cantidad" required v-model="cantidad">
				</div><br>
				<div class="form-group">
					<div class="col">
							<label class="h4">Descuento</label>
					</div>
					<div class="col">
						<input type="number" class="form-control" name="descuento" placeholder="Descuento Aplicado al Producto" v-model="descuento"><br>
					</div>
				</div>
			<div class="form-group text-right pr-4">
					<button :disabled="!productoVenta" type="button" class="btn btn-primary" name="añadir" v-on:click="addProducto">Añadir <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
				  <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
				  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
				</svg></button>
			</div>
			<hr>
				<div class="form-group">
					<div class="row">
						<label class="h4">Cliente: </label>
						<div class="col col-md-6">
							<input type="text" class="form-control" v-model="codigoCliente" placeholder="Cédula del Cliente" required>
						</div>
						<div class="col">
							<button type="button" name="buscar" class="btn btn-otro" v-on:click="searchCliente">Buscar</button>
						</div>
					</div><br>
						<div class="alert alert-info" v-if="bcliente && bcliente != ''">
							<input type="hidden" name="id_cliente" :value="bcliente.id">
							<p><strong v-html="clienteDescripcion"></strong></p>
						</div>
				</div>
			<div class="col">
				<label class="h4">Vendedor</label>
				<input type="text" disabled="" value="{{ auth()->user()->name }}" class="form-control">
			</div><br>
			<br>
			<div v-if="totalVenta > 0">
			  <label class="h4">
				<input type="radio" v-model="estadoVenta" name="estado" value="1" checked="">&nbsp;Venta completa
			</label>
			<br><!--
			<label class="h4">
				<input type="radio" v-model="estadoVenta" name="estado" value="0">&nbsp;Venta por sistema de apartado
			</label>
			<br>
			<label class="h4">
				<input type="radio" v-model="estadoVenta" name="estado" value="2">&nbsp;Fiado
			</label>
			<br>
			<div class="row" v-if="estadoVenta == 0">
				<div class="form-group">
					<label for="valor_abono">Valor del abono</label>
					<input type="number" class="form-control" name="valor_abono" v-on:keyup="validarAbonoVenta" v-model="valorAbonoVenta">
				</div>
			</div> -->
		</div>
			<br>
			<input type="submit" :disabled="itemsVenta.length<=0 || (estadoVenta == 0 && valorAbonoVenta <= 0)" class="btn btn-otro" name="registrar" value="Finalizar Venta">
			</div>
		<div class="col-md-6">
			<div class="table-responsive p-2 bg-white">
				<div class="h5 text-center">Detalle de Venta</div>
				<table class="table table-hover table-stripped table-sm">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Categoría</th>
							<th>Marca</th>
							<th>Cantidad</th>
							<th>Descuento</th>
							<th>Precio</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="item in itemsVenta">
							<td>@{{ item.nombre }}<input type="hidden" name="cantidad_venta[]" :value="item.cantidadVenta"><input type="hidden" name="productos[]" :value="item.id">
								<input type="hidden" name="descuentos[]" :value="item.descuento"></td>
							<td v-text="item.color.nombre"></td>
							<td v-text="item.talla.nombre"></td>
							<td v-text="item.cantidadVenta"></td>
							<td v-text="formatNumber(item.descuento)"></td>
							<td v-text="item.p_venta"></td>
						</tr>
					</tbody>
				</table><br><br>
				<label class="h5"><strong>TOTAL @{{ formatNumber(totalVenta) }}</strong></label>
			</div>
		</div>
		</div><br>
	</form>
</div><br><br>
@endsection
@section('actionUrlJs')
<script>
	var action = 'createVentas';
</script>
@endsection