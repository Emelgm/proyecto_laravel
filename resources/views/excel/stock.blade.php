<table class="table">
<h2 class="h2 text-center">Listado de Bodega</h2>
<thead class="thead-dark">
<tr>
	<th style="background-color: #000000;color:#ffffff;">REFERENCIA</th>
	<th style="background-color: #000000;color:#ffffff;">MODELO</th>
	<th style="background-color: #000000;color:#ffffff;">CATEGORIA</th>
	<th style="background-color: #000000;color:#ffffff;">MARCA</th>
	<th style="background-color: #000000;color:#ffffff;">CANTIDAD</th>
	<th style="background-color: #000000;color:#ffffff;">COMPRA c/u</th>
	<th style="background-color: #000000;color:#ffffff;">VENTA c/u</th>
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
<thead>
<tr>
    <th style="background-color: #000000;color:#ffffff;">RELACION ECONOMICA</th>
</tr>
<tr>
		<th style="background-color: #000000;color:#ffffff;">TOTAL DE PRODUCTOS</th>
		<th style="background-color: #000000;color:#ffffff;">TOTAL DE COMPRA</th>
		<th style="background-color: #000000;color:#ffffff;">TOTAL DE VENTA</th>
		<th style="background-color: #000000;color:#ffffff;">GANANCIAS $</th>
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
</table>