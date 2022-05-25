<div class="wrapper">
    <div style="margin-left: 19%;">
        <img width="14%" style="margin-top: 1%" src="{{ asset('/img/icons/logogeotracking.PNG') }}" alt="GG">
    </div>
    {{-- @include('layouts.sidebar') --}}
    <div>
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent"
            style="box-shadow: 2px 3px 5px #d4d4d4;">
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="navbar-nav" style="margin-right: 12%">

                    <li class="nav-item btn-rotate dropdown">
                        <a class="nav-link" href="{{ url('mapa') }}">
                            <strong>Mapa</strong>
                        </a>
                    </li>
                    <li class="nav-item btn-rotate dropdown">
                        <a class="nav-link" href="{{ url('conductor') }}">
                            <strong>Conductores</strong>
                        </a>
                    </li>
                    <li class="nav-item btn-rotate dropdown">
                        <a class="nav-link" href="{{ url('empresa') }}">
                            <strong>Empresas</strong>
                        </a>
                    </li>
                    <li class="nav-item btn-rotate dropdown">
                        <a class="nav-link" href="{{ url('vehiculo') }}">
                            <strong>Vehiculos</strong>
                        </a>
                    </li>
                </ul>
            </div>
            <li class="nav-item btn-rotate dropdown" style="margin-bottom: 1%">
               <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink2"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="nc-icon nc-bullet-list-67"></i>
               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                   <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST"
                       style="display: none;">
                       @csrf
                   </form>
                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                       <a class="dropdown-item" onclick="logout()">{{ __('Cerrar sesion') }}</a>
                   </div>
               </div>
           </li>
        </nav>


        @yield('content')
        @include('layouts.footer')
    </div>
</div>
@push('scripts')
    <script>
        function logout() {
            myAlert.Confirmation('¿Estas Seguro?', 'Se cerrara la sesion').then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formLogOut').submit();
                }
            });
        }
    </script>
@endpush
