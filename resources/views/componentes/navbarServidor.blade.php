

<nav class="navbar navbar-expand-lg" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);" role="navigation">
  <a class="navbar-brand" href="{{ route('login') }}" style="color: white; font-weight: bold;">
    <img src="{{asset('images/home.png')}}" height="20" class="d-inline-block align-top" alt="">

  </a>
    <div class="collapse navbar-collapse" >
      <ul class="navbar-nav mr-auto">
      </ul>
    </div>
    <div class="nav navbar-nav navbar-right" >
            <ul class="nav navbar-nav">
                @if(Auth::check())
                <li>
                <a class="nav-link"
                   onclick="event.preventDefault();"style="color:white; margin-right:20px">
                   {{Auth::user()->name}}
                </a>
                <!-- <form id="usuario-form" action="{{ route('home') }}" method="GET" style="display: none;">
                    @csrf
                </form> -->
              </li>
                @endif
            </ul>
            &nbsp
      <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
          <li>
          <a class="nav-link"  href="{{ route('alterar-senha-servidor') }}"
             onclick="event.preventDefault();
                           document.getElementById('usuario-form').submit();"style="color:white;" selection__placeholder="Alterar senha">
          <!-- <img src="{{asset('images/senha.png')}}" height="20" class="d-inline-block align-top" alt="" style="color:white"> -->
          <label for="">Alterar senha</label>
          </a>
          <form id="usuario-form" action="{{ route('alterar-senha-servidor') }}" method="GET" style="display: none; margin-right:20px">
              @csrf
          </form>
        </li>
          @endif
      </ul>


      <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
            <li> <!--  logout   -->
                <a class="nav-link"  href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"style="color:white;margin-right:20px">
                   {{ __('Sair') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endif
      </ul>
    </div>
  </nav>
<div>@include('componentes.mensagens')</div>
@php($url = str_replace(URL::to('/'),'',URL::current()))
