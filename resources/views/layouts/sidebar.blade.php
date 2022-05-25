<div class="sidebar" data-color="black" data-active-color="warning">
    <div class="logo">
        <a href="{{ route('perfil.edit') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                @if((auth()->user()->photo) <> null)
                    <img src="{{ asset('storage/') }}/{{__(auth()->user()->photo)}}" alt="...">
                @else
                    <img src="{{ asset('paper') }}/img/logo-small.png">
                @endif
            </div>
        </a>
        <a href="{{ route('perfil.edit') }}" class="simple-text logo-normal">
            {{ __('GeoTracking') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @foreach ($modules as $module)
            @if ($module->module_visible)
             <li class="{{ $elementActive == $module->module_reference ? 'active' : '' }}">
                <a href="{{ route($module->action_route) }}">
                    {!! $module->module_icon !!}
                    @if ($module->module_name == "Parameters")
                        <p>{{__('Parametros') }}</p>
                    @else
                        <p>{{ $module->module_name }}</p>
                    @endif
                </a>
            </li>
            @endif
          @endforeach
            {{-- <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'clientes' ? 'active' : '' }}">
                <a href="{{ route('clientes.index') }}">
                    <i class="nc-icon nc-circle-10"></i>
                    <p>{{ __('Clientes') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'usuarios' ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>{{ __('Usuarios') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'files-admin' ? 'active' : '' }}">
                <a href="{{ route('files-admin.index') }}">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>{{ __('Gestor de archivos') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'alertas' ? 'active' : '' }}">
                <a href="{{ route('alerting.index') }}">
                    <i class="nc-icon nc-chat-33"></i>
                    <p>{{ __('Envio SMS y Email') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'parametersValues' ? 'active' : '' }}">
                <a href="{{ route('valores-parametros.index') }}">
                    <i class="nc-icon nc-layout-11"></i>
                    <p>{{ __('Valores Parametros')}}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
