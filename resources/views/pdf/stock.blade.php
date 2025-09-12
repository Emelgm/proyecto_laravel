<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prestamo</title>
	<link rel="stylesheet" href="{{ public_path().'/css/style.css' }}">
	<link rel="stylesheet" href="{{ public_path().'/css/bootstrap.css' }}">
</head>
<body>
	<table class="table">
		<caption class="h2 text-center">Listado de Bodega</caption>
	<thead class="thead-dark">
		<tr>
			<th>Referencia</th>
			<th>Modelo</th>
			<th>Color</th>
			<th>Talla</th>
			<th>Cantidad</th>
			<th>Compra c/u</th>
			<th>Venta c/u</th>
		</tr>
	</thead>
	<tbody class="text-center">
		@php
			$total_p=0;
			$total_c=0;
			$total_v=0;
			$tota_u=0;
			$ganancias=0;
		@endphp
		@foreach($stock as $st)
		<tr>
			<td>{{ $st->id }}</td>
			<td>{{ $st->modelo->nombre }}</td>
			<td>{{ $st->color->nombre }}</td>
			<td>{{ $st->talla->nombre }}</td>
			<td>{{ $st->cantidad }}</td>
			<td>{{ $st->p_compra }}</td>
			<td>{{ $st->p_venta }}</td>
		@php
			$total_p+=$st->cantidad;
			$total_uc=$st->cantidad*$st->p_compra;
			$total_uv=$st->cantidad*$st->p_venta;
			$total_c+=$total_uc;
			$total_v+=$total_uv;
			$ganancias=$total_v-$total_c;
		@endphp
		</tr>
		@endforeach
	</tbody>
	</table><br>
	<table class="table">
		<caption class="h2 text-center">Relación económica</caption>
		<thead class="thead-dark">
			<tr>
				<th>Total de productos</th>
				<th>Total de compra</th>
				<th>Total de venta</th>
				<th>Ganancias $</th>
		</tr>
			</tr>
		</thead>
		<tbody class="text-center">
			<tr>
				<td>{{ $total_p }}</td>
				<td>{{ $total_c }}</td>
				<td>{{ $total_v }}</td>
				<td>{{ $ganancias }}</td>
			</tr>
		</tbody>
	</table><br>
<footer class="text-center">
	<em>Calzado YAZAY</em> 
</footer>
</body>
</html>