<!DOCTYPE html>
<html lang="es">
<head>
	<title>Factura</title>
	<style>
        * {
            font-size: 10px;
            font-family: 'DejaVu Sans', serif;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 180px;
            max-width: 180px;
        }

        * {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 3px;
            margin-right: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="ticket" id="factura">
	<div class="">
			<div class="" align="right">	
					Papelería Ximena <br>
					Calle 12 #18-70 La Libertad <br>
					Cúcuta - N.S.
			</div>
	</div><hr>
	<div class="">
			@php
				$fecha = date("Y",strtotime($venta->created_at));
				$p_t = number_format($venta->total,0,',','.');
			@endphp
			<div class="">
					<strong>FACTURACIÓN #{{ $venta->id }}</strong>
			</div>
			<div class="">	
					Fecha: {{ $venta->created_at }}
			</div>
	</div>
	<div class="">
			<div class="" style="text-align: left;">
					<strong>{{ $venta->cliente->nombres }} {{ $venta->cliente->apellidos }}</strong><br>
					C.C {{ $venta->cliente->id }}<br>
					Telef: {{ $venta->cliente->telefono }}
			</div>
			<div class=" text-right">
				<strong>TOTAL: {{ $p_t }} COP</strong>
			</div>
	</div>
	<div class="bg-white">
			<table class="table-stripped">
				<thead>
					<tr>
						<th>PDTO</th>
						<th>CANT</th>
						<th>DTO</th>
						<th>VLR</th>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody>
				@php
					$total_u=0;
					$total_t=0;
					$dto=0;
					$p_u=0;
					$total_uu=0;
					$total_tt=0;
					$dsc=0;
					$v_r=0;
				@endphp
				@foreach($venta->venta_producto as $vent)
				<tr align="center">
					<td>{{ $vent->productos->nombre }}</td>
					<td>{{ $vent->cantidad }}</td>
					@php
						$desc=$vent->descuento;
						$p_venta=$vent->p_detalle;
						$p_u=number_format($p_venta,0,',','.');
						$dto=number_format($desc,0,',','.');
						$total_uu = number_format($total_u=($vent->cantidad*$vent->p_detalle)-$vent->descuento,0,',','.');
					@endphp
					<td>{{ $dto }}</td>
					<td>{{ $p_u }}</td>
					<td>{{ $total_uu }}</td>
					@php
						$dsc +=$desc;
						$v_r+=$vent->cantidad*$vent->p_detalle;
						$v_rr=number_format($v_r,0,',','.');
						$total_t+=$total_u;
						$total_tt=number_format($total_t,0,',','.');
						$descu=number_format($dsc,0,',','.');
					@endphp
				</tr>
				@endforeach
				</tbody>
			</table><br>
			<div class="text-right"><strong>VALOR REAL: {{ $v_rr }} COP</strong></div>
			<div class="text-right"><strong>VALOR DTO: {{ $descu }} COP</strong></div>
			<div class="text-right"><strong>TOTAL: {{ $total_tt }} COP</strong></div>
		</div>
</div><br>
<footer class="ticket centrado">
	<em>¡Gracias por comprar!</em> 
</footer>
</body>
</html>