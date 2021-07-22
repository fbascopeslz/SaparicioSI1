<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SistemaDA | </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('inventario')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SD</b>A</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SDAparicio</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-red">Online</small>
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                     Pequeño detalle o configuracion
                      <small>www.ruta/url</small>     
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" class="btn btn-primary" 
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesion
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                    <!--<a href="{{ url('/login') }}" class="btn btn-danger">Registrar</a>-->
                    </div>                   
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Inventario</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('inventario.index') 
                 
             <li><a href="{{url('inventario')}}"><i class="fa fa-circle-o"></i>Inventario</a></li>
                  @endcan
                 @can('inventario.almacen.index') 
                     <li><a href="{{url('inventario/almacen')}}"><i class="fa fa-circle-o"></i> Almacen</a></li>
                      @endcan
                <li><a href="{{url('inventario/producto')}}"><i class="fa fa-circle-o"></i> Producto</a></li>

              @can('inventario.tipobebida.index')
                <li><a href="{{url('inventario/tipobebida')}}"><i class="fa fa-circle-o"></i> Tipo de Bebida</a></li>
               @endcan
               @can('inventario.sabor.index')
                 <li><a href="{{url('inventario/sabor')}}"><i class="fa fa-circle-o"></i> Sabor</a></li>
                  @endcan
                 @can('inventario.tipoenvase.index')
                <li><a href="{{url('inventario/tipoenvase')}}"><i class="fa fa-circle-o"></i> Tipo de Envase</a></li>
                 @endcan
                @can('inventario.paquete.index')
                 <li><a href="{{url('inventario/paquete')}}"><i class="fa fa-circle-o"></i> Paquete</a></li>
                  @endcan
                 @can('inventario.medida.index')
                <li><a href="{{url('inventario/medida')}}"><i class="fa fa-circle-o"></i> Medida</a></li>
                 @endcan
                @can('inventario.marca.index')
                 <li><a href="{{url('inventario/marca')}}"><i class="fa fa-circle-o"></i> Marca</a></li>
               @endcan
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                @can('compras.ingreso.index')
                <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                @endcan
              
                @can('compras.proveedor.index')
                <li><a href="{{url('compras/proveedor')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                @endcan
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('ventas.pedido.index')
                <li><a href="{{url('ventas/pedido')}}"><i class="fa fa-circle-o"></i> Pedidos</a></li>
                 @endcan
                 @can('ventas.entrega.index')
                 <li><a href="{{url('ventas/entrega')}}"><i class="fa fa-circle-o"></i> Entrega</a></li>
                 @endcan
                @can('ventas.cliente.index')
                <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                @endcan
                @can('ventas.zona.index')
                <li><a href="{{url('ventas/zona')}}"><i class="fa fa-circle-o"></i>Zona</a></li>
                @endcan
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Personal</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('personal.user.index')
                <li><a href="{{url('personal/user')}}"><i class="fa fa-circle-o"></i> Reg empleado</a>
                @endcan
                @can('personal.cargo.index')
                <li><a href="{{url('personal/cargo')}}"><i class="fa fa-circle-o"></i>Cargo</a></li> 
                @endcan
                @can('roles.index')
                 <li><a href="{{url('roles') }}"><i class="fa fa-circle-o"></i>Roles</a></li> 
                 @endcan
                @can('users.index')
                 <li><a href="{{url('users') }}"><i class="fa fa-circle-o"></i>Usuario</a></li> 
                 @endcan
                 @can('personal.zonaempleado.index')
                  <li><a href="{{url('personal/zonaempleado') }}"><i class="fa fa-circle-o"></i>zona empleado</a></li> 
                  @endcan
                </li>
              </ul>
            </li>
             <!--<li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                   -->   
            <li class="treeview">
              <a href="#">
                <i class="fa fa-fw fa-database"></i> <span>REPORTES</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{url('Reportes')}}"  ><i class="fa fa-circle-o"></i> Reportes </a></li>
                
              </ul>
            </li> 				   
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">SIstema</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
               @if (session('info'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="alert alert-success">
                                {{ session('info') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <!--<strong>Copyright &copy; 2015-2020 <a href="www.incanatoit.com">IncanatoIT</a>.</strong> All rights reserved.-->
        <strong>Distribuidora  <a href="www.DAparicio.com">Aparicio</a>SRL</strong>
      </footer>

      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!--Bootstrap Select-->
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>
</html>