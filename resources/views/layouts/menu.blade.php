<li class="c-sidebar-nav-item {{ request()->routeIs('home') ? 'c-active' : '' }}">
    <a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon bi bi-house" style="line-height: 1;"></i> Home
    </a>
</li>





@can('access_machines')
    <br>
    <br>
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('machines.*') || request()->routeIs('machine-categories.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-building" style="line-height: 1;"></i> Base de Datos Equipos
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_machine_categories')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('machine-categories.*') ? 'c-active' : '' }}"
                        href="{{ route('machine-categories.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i> Categoria/Modelo
                    </a>
                </li>
            @endcan
            @can('create')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('machines.create') ? 'c-active' : '' }}"
                        href="{{ route('machines.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Crear Equipo
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('machines.index') ? 'c-active' : '' }}"
                    href="{{ route('machines.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Todos los Equipos
                </a>
            </li>
            @can('create')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('import-machines.create') ? 'c-active' : '' }}"
                        href="{{ route('import-machines.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-arrow-down-square" style="line-height: 1;"></i> Importar Equipos
                    </a>
                </li>
            @endcan
            @can('print_barcodes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('barcode.print') ? 'c-active' : '' }}"
                        href="{{ route('barcode.print') }}">
                        <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> Print Barcode
                    </a>
                </li>
            @endcan

        </ul>
    </li>
@endcan



@can('access_informats')


    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('informats.*') || request()->routeIs('institute.*') || request()->routeIs('area.*') || request()->routeIs('units.*') || request()->routeIs('machine.*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-pip" style="line-height: 1;"></i> Configuración Servicio.
        </a>

        <ul class="c-sidebar-nav-dropdown-items">
            @can('access_informat_institutes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('institute.*') ? 'c-active' : '' }}"
                        href="{{ route('institute.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-bank" style="line-height: 1;"></i> Hospitales
                    </a>
                </li>
            @endcan
            @can('access_brands')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('brand.*') ? 'c-active' : '' }}"
                        href="{{ route('brand.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-speaker" style="line-height: 1;"></i> Marca
                    </a>
                </li>
            @endcan
            
            @can('access_informat_areas')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('area.*') ? 'c-active' : '' }}"
                        href="{{ route('area.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-textarea" style="line-height: 1;"></i> Áreas
                    </a>
                </li>
            @endcan




            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('informats.index') ? 'c-active' : '' }}"
                    href="{{ route('informats.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Insumos .
                </a>
            </li>

        </ul>
    </li>
@endcan
@can('access_user_management')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('roles*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i> Gestión del Usuario.
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            @can('create')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('users.create') ? 'c-active' : '' }}"
                        href="{{ route('users.create') }}">
                        <i class="c-sidebar-nav-icon bi bi-person-plus" style="line-height: 1;"></i> Crear Usuario
                    </a>
                </li>
            @endcan
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->routeIs('users*') ? 'c-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <i class="c-sidebar-nav-icon bi bi-person-lines-fill" style="line-height: 1;"></i> Todo los usuarios
                </a>
            </li>
            @can('access_roles')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('roles*') ? 'c-active' : '' }}"
                        href="{{ route('roles.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-key" style="line-height: 1;"></i> Roles y Permisos.
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@can('access_settings')
    <li
        class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('settings*') || request()->routeIs('settings*') ? 'c-show' : '' }}">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon bi bi-gear" style="line-height: 1;"></i> Configuración
        </a>


        @can('access_settings')
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->routeIs('settings*') ? 'c-active' : '' }}"
                        href="{{ route('settings.index') }}">
                        <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i> Configuración del Sistema
                    </a>
                </li>
            </ul>
        @endcan
    </li>
@endcan
