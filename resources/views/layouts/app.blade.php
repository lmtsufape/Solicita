<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Solicita</title>

    <script src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('js/jquery-mask-plugin.js')}}"></script>
    <link rel="stylesheet" href="{{ asset ('css/stylelmts.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/app.css') }}">
    <link href="{{ asset('css/field-animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles/style.css') }}" rel="stylesheet">

    <style type="text/css">
        

        .td-align {
           text-align: center;     /* alinhamento horizontal */
           vertical-align: middle; /* alinhamento vertical */
        }

        .bloco{
          background-color: #edf0f5;
        }
        .glyphicon{
          font-size:16px;
          }

        .panel-default > .panel-heading {
            color: #fff;
            background-color: #1B2E4F;
            border-color: #d3e0e9;
        }
        /* Select2 Selects CSS - Start */
        .select2-container--bootstrap .select2-selection--single .select2-selection__placeholder  {
            color: #555;
        }
        .select2-container--bootstrap .select2-results__option {
            color: #555;
            background-color: #fff;
        }
        .select2-container--bootstrap .select2-results__option--highlighted[aria-selected] {
            color: #fff;
            background-color: #bbb;
        }
        .select2-container--bootstrap .select2-selection--single {
            height: 36px;
            padding: 6px 18px;
            margin-left: 0px;
        }
        /* Select2 Selects CSS - End */
        #termo {
          width: 100%;
          font-size: 16px;
          padding: 12px 20px 12px 40px;
          border: 1px solid #ddd;
          margin-bottom: 12px;
        }
        .navbar-default .navbar-nav > .dropdown > a:focus, .navbar-default .navbar-nav > .dropdown > a:hover {
            color: #fff;
            background-color: #1B2E4F;
        }
        .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
            color: #000;
            background-color: #fff;
        }
        .navbar-default .navbar-nav > a, .navbar-default .navbar-nav > li > a {
            color: #fff;
        }
        .navbar-default .navbar-nav > li > a:hover, {
            color: #fff;
            background-color: #fff;
        }
        .dropdown-menu > li > a:hover {
            background-color: #cccccc;
        }
        .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-text {
            color: #000;
            background-color: #fff;
        }
        #footer-brasil {
           background: none repeat scroll 0% 0% #1B2E4F;
           min-width: 100%;
           position: absolute;
           bottom: 0;
           width: 100%;
           display: none;
        }
        #page-container {
          position: relative;
          min-height: 100vh;
        }
        #content-wrap {
          padding-bottom: 2.5rem;    /* Footer height */
        }
        @media (max-width: 1024px) {
          #barra-logos{display: none;}
          .btn-toggle{display: block;}
        }
        @media only screen and (max-width: 1024px) {
        	/* Force table to not be like tables anymore */
        	#tabela table,
        	#tabela thead,
        	#tabela tbody,
          #tabela tfoot,
        	#tabela th,
        	#tabela td,
        	#tabela tr {
        		display: block;
        	}
        	/* Hide table headers (but not display: none;, for accessibility) */
        	#tabela thead tr {
        		position: absolute;
        		top: -9999px;
        		left: -9999px;
        	}
        	#tabela tr { border: 1px solid #ccc; }
        	#tabela td {
        		/* Behave  like a "row" */
        		border: none;
        		border-bottom: 1px solid #eee;
        		position: relative;
        		padding-left: 50%;
        		white-space: normal;
        		text-align:left;
        	}
        	#tabela td:before {
        		/* Now like a table header */
        		position: absolute;
        		/* Top/left values mimic padding */
        		top: 6px;
        		left: 6px;
        		width: 45%;
        		padding-right: 10px;
        		white-space: nowrap;
        		text-align:left;
        		font-weight: bold;
        	}
        	/*
        	Label the data
        	*/
        	#tabela td:before { content: attr(data-title); }
        }
        .dropbtn {
          background-color: #3097D1;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }
        .dropbtndisabled {
          background-color: #8eb4cb;;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }
        /* The container <div> - needed to position the dropdown content */
        .dropdown {
          position: relative;
          display: inline-block;
        }
        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #8eb4cb;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        /* Links inside the dropdown */
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1}
        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
          display: block;
        }
        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
          background-color: #3097D1;
        }
        .separador-lmts{     /*       Separador de navbar */
          color: white;
          font-weight: bold;
          font-size: 20;
          margin-top: 6px;
        }
        /* Botão com cor padrão do lmts */
        .btn-primary-lmts{
          background-color: #1B2E4F;
          border-color: #d3e0e9;
          color: white;
        }
        .btn-primary-lmts:disabled{
          background-color: #1B2E4F;
          border-color: #d3e0e9;
          color: white;
        }
        .btn-primary-lmts:hover{
          background-color: #2c4e8a;
          border-color: #d3e0e9;
          color: white;
        }
        /* badge lmts */
        .badge-lmts{
          padding: 5px;
          color: white;
          font-size: 13px;
          background-color: #67748B;
          margin-left: 5px;
          margin-top: 5px;
        }
    </style>
</head>
<body>
  <!-- Barra Brasil -->
  <div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
    <ul id="menu-barra-temp" style="list-style:none;">
        <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED">
            <a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a>
        </li>
        <li>
        <a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a>
        </li>
    </ul>
  </div>
  {{-- <div id="content-wrap">
  </div> --}}
    <!-- Barra de Logos -->
    <div id="barra-logos" lass-"container" style="background:#FFFFFF; margin-top: 1px; height: 150px; padding: 10px 0 10px 0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
      <ul id="logos" style="list-style:none;">
          <li style="margin-right:140px; margin-left:110px; border-right:1px ;height: 120px">
              <a href="{{ route('login') }}"><img src="{{asset('images/logo.png')}}" style = "margin-left: 8px; margin-top:5px " height="120px" align = "left" ></a>

              <a target="_blank" href="http://lmts.uag.ufrpe.br/"><img src="{{asset('images/lmts.jpg')}}" style = "margin-left: 8px; margin-top:30px " height="70%"  align = "right" ></a>
              <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70" align = "right" >
              <a target="_blank" href="http://www.ufrpe.br/"><img src="{{asset('images/ufrpe.png')}}" style = "margin-left: 8px; margin-top:30px " height="70"  align = "right" ></a>

              <img src="{{asset('images/separador.png')}}" style = "margin-left: 15px; margin-top: 30px" height="70" align = "right" >
              <a target="_blank" href="http://ww3.uag.ufrpe.br/"><img src="{{asset('images/logoUfapeAzul.svg')}}" style = "margin-left: 15px; margin-right: -10px; margin-top: 30px " height="70" width="50" align = "right"></a>
          </li>
      </ul>
    </div>
    <!-- barra de menu -->

    <!-- se o usuário estiver logado -->
    @if(Auth::check())
        <!-- Se o usuário for um aluno -->
        @if(Auth::user()->tipo == 'aluno')
            <!-- carrega o componente contendo Navbar do aluno -->
            @component('componentes.navbarAluno')
            @endcomponent
        @endif

        <!-- Se o usuário for um servidor -->
        @if(Auth::user()->tipo == 'servidor')
            <!-- Carrega component contendo navbar do servidor -->
            @component('componentes.navbarServidor')
            @endcomponent
        @endif

        @if(Auth::user()->tipo == 'administrador')
            <!-- Carrega component contendo navbar do administrador -->
            @component('componentes.navbarAdministrador')
            @endcomponent
        @endif
    @endif
    @yield('conteudo')
  <!-- rodape -->
	<div class="styleRodape">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="row justify-content-center">
						<div class="col-sm-12 styleRodape_Imagem_ufape">
							<a href="http://ww3.uag.ufrpe.br/"><img src="{{asset('images/logoUfape.svg')}}" alt="Logo" width="40px;" /></a>
						</div>
						<div class="col-sm-12 styleRodape_Texto">
							<label>Universidade Federal do Agreste de Pernambuco</label>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="row justify-content-center">
						<div class="col-sm-12 styleRodape_Imagem_lmts">
							<a href="http://lmts.uag.ufrpe.br/"><img src="{{asset('icones/lmts_logo.png')}}" alt="Logo" width="125px;" /></a>
						</div>
						<div class="col-sm-12 styleRodape_Texto">
							<label>Laboratório Multidisciplinar de Tecnologias Sociais</label>
						</div>
					</div>
				</div>
				<div class="col-sm-2" >
					<div class="row" style="width: 90%">
						<div class="styleRodape_linha_left">
							<div class="col-sm-12 styleRodape_Texto_Titulo">Mapa do site</div>
              <div class="col-sm-12 styleRodape_Texto_Conteudo_MapaDoSite"><a href="http://lmts.uag.ufrpe.br/br/content/apresenta%C3%A7%C3%A3o" style="color:white">Quem Somos</a></div>
              <div class="col-sm-12 styleRodape_Texto_Conteudo_MapaDoSite"><a href="http://lmts.uag.ufrpe.br/br/content/solicita" style="color:white">O Solicita</a></div>
							<div class="col-sm-12 styleRodape_Texto_Conteudo_MapaDoSite"><a href="http://lmts.uag.ufrpe.br/br/content/equipe" style="color:white">Equipe</a></div>
							<div class="col-sm-12 styleRodape_Texto_Conteudo_MapaDoSite"><a href="http://lmts.uag.ufrpe.br/br/noticias" style="color:white">Notícia</a></div>
							<div class="col-sm-12 styleRodape_Texto_Conteudo_MapaDoSite"><a href="http://lmts.uag.ufrpe.br/br/content/projetos" style="color:white">Projetos</a></div> 
						</div>
					</div>
				</div>
				<div class="col-sm-3" style="width: 110%;">
					<div class="row">
						<div class="styleRodape_linha_left">
							<div class="col-sm-12 styleRodape_Texto_Titulo">Contato</div>
								<div class="col-sm-12 styleRodape_container">
									<div class="row">
										<div class="col">
											<img src="{{asset('icones/instagram_logo.svg')}}" alt="Logo" width="20px;" />
											<a href="" class="styleRodape_Texto_Contato" style="color: white;">@lmts_ufape

                      </a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 styleRodape_container">
									<div href="" class="row">
										
										<div class="col">
											<img src="{{asset('icones/facebook_logo.svg')}}" alt="Logo" width="20px;" />
											<a href="" class="styleRodape_Texto_Contato" style="color: white;">@lmtsufape</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 styleRodape_container">
									<div class="row">
										<div class="col">
											<img src="{{asset('icones/twitter-brands.svg')}}" alt="Logo" width="20px;" />
											<a href="https://twitter.com/lmtsufape" class="styleRodape_Texto_Contato" style="color: white;">@lmtsufape</a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 styleRodape_container">
									<div class="row">
										<div class="col">
											<img src="{{asset('icones/linkedin-brands.svg')}}" alt="Logo" width="20px;" />
											<a href="https://br.linkedin.com/in/lmts-ufrpe-0b25b9196?trk=people-guest_people_search-card" class="styleRodape_Texto_Contato" style="color: white;">LMTS</a>
										</div>
									</div>
								</div>
						</div>
					</div>
        </div>
        
				<div class="col-sm-2 ">
					<div class="row">
						<div class="styleRodape_linha_left">
							<div class="col-sm-12 styleRodape_Texto_Titulo">Apoio</div>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-12" style="padding-bottom: 1rem; padding-left: 10px;">
										<a href="http://www.ufrpe.br/"><img src="{{asset('icones/logo-ufrpe-branca.png')}}" alt="Logo" height="115px;" /></a>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center styleRodape_container styleRodape_linha_top">
				<img src="{{asset('icones/local_logo.svg')}}" alt="Logo" width="10px;" />
				<a class="styleRodape_Texto" style="padding: 0.5rem; color: white;">Avenida Bom Pastor. s/nº Bairro Boa Vista - CEP 55292-270 - Garanhuns - PE</a>
			</div>
		</div>
	</div>
	<!--x rodape x-->

</body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

</html>
