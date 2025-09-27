<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('titulo')</title>
		<link rel="shortcut icon" type="image/png" href="{{asset('img/ico.png')}}">
		<link rel="stylesheet" href="{{asset('css/app.css')}}">
		<link rel="stylesheet" href="{{asset('css/estilo.css')}}">
		<link rel="stylesheet" href="{{asset('plugins/chosen/chosen.min.css')}}">
		@yield('css')
	</head>
	<body><br>
		<div id="app">
		<div class="container">
		@guest
		@else
		<div class="text-right">
			<span class="badge badge-pill badge-light"><h5>Bienvenido {{auth()->user()->name}}</h5></span>
		<div class="btn-group" role="group">
	    	<button id="btnGroupDrop1" type="button" class="btn btn-otro dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
				  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
				  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
				</svg>
    		</button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    	@can(!'has.role:vendedor')
      <a class="dropdown-item" href="{{ route('register') }}">Crear Usuario</a>@endcan
      {{--  <a class="dropdown-item" href="{{ route('usuarios.index') }}">Listado Usuarios</a>--}}
      <a href="#" class="dropdown-item" title="Cerrar sesion" onclick="event.preventDefault();
													   document.getElementById('logout-form').submit();">Cerrar sesión</a>
    </div>
  </div>
		</div>
		@endguest
		<form id="logout-form" action="{{ route('logout') }}" method="post" class="hide">
			{{ csrf_field() }}
		</form><br>
		</div>
		<div id="logo" class="container" style="background-color: #205d8f"><center>
			<img src="{{asset('img/loggo.png')}}" alt="mysql" width="500" height="120"><br>
			</center>
		</div><br>
		@yield('nav')
		<div class="container mt-3 mb-3">
		@include('fragment.error')
		</div>
		@yield('contenido')
		<footer class="container h6" align="center">
			Papelería Ximena<br>&copy; Desarrollado y Administrado por Interconn S.A.S desde 2025.
		</footer><br>
		</div>
		@yield('actionUrlJs')
		<script src="{{ asset('js/app.js') }}?v={{ time() }}"></script>
		<script src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}"></script>
		@yield('js')
	</body>
</html>
