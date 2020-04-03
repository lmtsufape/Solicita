

<nav class="navbar navbar-expand-lg" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);" role="navigation">
  <a class="navbar-brand" href="{{ route('login') }}" style="color: white; font-weight: bold;">
    <img src="{{asset('images/home.png')}}" height="20" class="d-inline-block align-top" alt="">

  </a>
    <div class="collapse navbar-collapse" >
      <!-- <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}" style="color:white">
                          {{ __('Inicio') }}
          </a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="{{route('cadastro-servidor')}}" style="color:white">
                          {{ __('Cadastrar Servidor') }}
          </a>
        </li>
      </ul> -->
    </div>

    <div class="nav navbar-nav navbar-right" >
      <ul class="nav navbar-nav">
          @if(Auth::check())
          <li>
          <a href="{{ route('home-administrador') }}" onclick="event.preventDefault(); document.getElementById('usuario-form').submit();" class="nav-link" style="color:white">
             {{Auth::user()->name}}
          </a>
          <form id="usuario-form" action="{{ route('home') }}" method="GET" style="display: none;">

          </form>
        </li>
          @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
            <li> <!--  logout   -->
                <a class="nav-link"  href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"style="color:white">
                   {{ __('Sair') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none; margin-right:20px">
                    @csrf
                </form>
            </li>
        @endif
      </ul>
    </div>
  </nav>
  <div>
@include('componentes.mensagens')
</div>
@php($url = str_replace(URL::to('/'),'',URL::current()))
