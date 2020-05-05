

<nav class="navbar navbar-expand-lg" style="background-color: #1B2E4F; border-color: #d3e0e9; box-shadow: 0 0 6px rgba(0,0,0,0.5);" role="navigation">
  <a class="navbar-brand" href="{{ route('login') }}" style="color: white; font-weight: bold;">
    <img src="{{asset('images/home.png')}}" height="20" class="d-inline-block align-top" alt="">

  </a>

    <div class="collapse navbar-collapse" >
      <ul class="navbar-nav mr-auto">
        @if(Auth::check())
          <li>
            <a class="nav-link"
               href="{{ route('relatorio-requisicoes') }}"style="color:white; margin-right:5px; margin-bottom:3px">
               <svg class="bi bi-archive" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 5v7.5c0 .864.642 1.5 1.357 1.5h9.286c.715 0 1.357-.636 1.357-1.5V5h1v7.5c0 1.345-1.021 2.5-2.357 2.5H3.357C2.021 15 1 13.845 1 12.5V5h1z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M5.5 7.5A.5.5 0 016 7h4a.5.5 0 010 1H6a.5.5 0 01-.5-.5zM15 2H1v2h14V2zM1 1a1 1 0 00-1 1v2a1 1 0 001 1h14a1 1 0 001-1V2a1 1 0 00-1-1H1z" clip-rule="evenodd"/>
              </svg> <span class="ml-1" > Relatorios </span>
            </a>
            
          </li>
          <li>
            <a class="nav-link"
               href="{{ route('pesquisar-aluno') }}"style="color:white; margin-right:5px; margin-bottom:3px">
               <svg class="bi bi-search" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
              </svg><span class="ml-1" > Pesquisar </span>
            </a>
            
          </li>
        @endif
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
          <label for="" class="mr-3">Alterar senha</label>
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

@php($url = str_replace(URL::to('/'),'',URL::current()))
