<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{asset('img/logo.png')}}" alt="Clock"
                 srcset="{{asset('img/acopagro.png')}} 200w, {{asset('img/acopagro.png')}} 200w"  sizes="(min-width: 200px) 25px, 10vw"/>
        </span>
        <!-- logo for regular state and mobile devices -->                                  
        <!-- logo for regular state and mobile devices -->
        <img src="{{asset('img/acopagro.png')}}" alt="Clock"  
             srcset="{{asset('img/acopagro.png')}} 200w, {{asset('img/acopagro.png')}} 200w"  sizes="(min-width: 200px) 25px, 10vw"/>
    </a>          
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>        
                </button>      
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
                </a>                
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li ><a href="{{ url('/socios') }}">Socios</a></li>
                    <li ><a href="{{ url('/RRHH/empleados') }}">RRHH</a></li>
                    <li class="active"><a href="{{ url('/Acopio/Fondos-Acopio') }}">Acopio</a></li>
                    <li><a href="{{ url('/Creditos/Creditos-Financieros') }}">Creditos</a></li>
                    <li><a href="#">Certificacion</a></li>
                    <li ><a href="{{ url('/Tesoreria/Distribucion-Fondos') }}">Tesoreria</a></li>
                    <li><a href="#">Contabilidad</a></li>
                    <li><a href="#">Informes</a></li>
                </ul> 
                @if(Auth::guest())
                <a onclick="estadoform({{Auth::guest()}})" id="idestado">activo</a>
                @else
                            
            <ul class="navbar-custom-menu">

                    
                        <ul class="nav navbar-nav">   
                            <!--mensajes de recepcion-->
                            <li class="dropdown messages-menu">                     
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">4</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">{{ trans('adminlte_lang::message.tabmessages') }}</li>
                                    <li>

                                        <ul class="menu">
                                            <li> 
                                                <a href="#">
                                                    <div class="pull-left">

                                                        <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                                    </div>

                                                    <h4>
                                                        {{ trans('adminlte_lang::message.supteam') }}
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>

                                                    <p>{{ trans('adminlte_lang::message.awesometheme') }}</p>
                                                </a>
                                            </li> 
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">c</a></li>
                                </ul>
                            </li>
                            
<!--<li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>-->                            
                            <li class="dropdown user user-menu">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!--The user image in the navbar-->
                                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"/>
                                    <!--hidden-xs hides the username on small devices so only the image appears.--> 
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!--The user image in the menu--> 
                                    <li class="user-header">
                                        <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                                        <p>{{ Auth::user()->name }}</p>
                                        <p>Cargo: Administrador</p>
                                    </li>                                   
                                    <!--Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-primary btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ url('/logout') }}" class="btn btn-primary btn-flat">Cerrar Sesion</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                         
                            <!--Control Sidebar Toggle Button--> 
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>                    
                </ul>
                            @endif
            </div>            
        </div>        
    </nav> 
</header>
