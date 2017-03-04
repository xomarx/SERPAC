
<!DOCTYPE html>
<html lang="es">
    <!--head de la web-->    
    
        @include('layouts.partials.htmlheader')    
    <body  class="skin-blue sidebar-mini">
        <div class="wrapper">
            <!--MENU PRINCIPAL DE MODULOS DEL SISTEMA--> 
            @include('layouts.partials.mainheader')
            <aside class="main-sidebar">
                @yield('sidebar')
            </aside>
            <div class="content-wrapper">
                <!--TITULO DEL CONTENIDO-->
                @include('layouts.partials.contentheader')
                <!-- Main content -->
                <section class="content" id="main-content">
                    <!-- Your Page Content Here -->
                    @yield('main-content')
                </section><!-- /.content -->
            </div>
            @include('layouts.partials.controlsidebar')

            @include('layouts.partials.footer')
        </div>
        @include('layouts.partials.scripts')
        @yield('script')
    </body>
</html>

