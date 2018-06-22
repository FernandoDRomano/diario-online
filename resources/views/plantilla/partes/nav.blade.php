<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <a class="navbar-brand" href="{{url('/')}}"> Tucumán Informa </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    {{-- SI EL USUARIO ESTA AUTENTICADO --}}

    @if (Auth::check())

    {{-- SI EL USUARIO ES UN ADMINISTRADOR --}}
    @if (Auth::user()->role->nombre == 'Administrador')

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('categorias')}}">Categorías <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('empleados')}}">Empleados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('etiquetas')}}">Etiquetas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('lectores')}}">Lectores</a>
        </li>
      </ul>
      @endif
      {{-- FIN DEL USUARIO ADMINISTRADOR --}}

      {{-- SI ES UN USUARIO ESCRITOR O ADMINISTRADOR--}}
      @if (Auth::user()->role->nombre == 'Escritor' or Auth::user()->role->nombre == 'Administrador')
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{url('noticias')}}">Noticias</a>
        </li>
      </ul>

      @endif

      @if (Auth::user()->role->nombre == 'Moderador' or Auth::user()->role->nombre == 'Administrador')
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{url('comentarios')}}">Comentarios</a>
          </li>
        </ul>
      @endif
      {{-- FIN DEL USUARIO ESCRITOR --}}
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                @if (Auth::user()->role->nombre == 'Administrador' or Auth::user()->role->nombre == 'Escritor' or Auth::user()->role->nombre == 'Moderador')
                    <img class="imagen_perfil" src="{{asset('imagenes/empleados/' . Auth::user()->empleado->foto)}}" alt="">
                  {{ Auth::user()->empleado->apellido .', ' . Auth::user()->empleado->nombre }} <span class="caret"></span>
                @else
                  {{ Auth::user()->lector->nombreApellido }} <span class="caret"></span>
                @endif
            </a>

            <div id="dropdown-menu-navbar" class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Salir
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>


    {{-- FIN DEL USUARIO AUTENTICADO --}}

      @else

    {{-- SI NO ESA AUTENTICADO --}}
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{url('login')}}">Iniciar Sesión</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('lectores/create')}}">Registrate</a>
      </li>
    </ul>
    {{-- FIN SI NO ESTA AUTENTICADO --}}

    @endif

  </div>
</nav>
