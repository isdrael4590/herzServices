<div class="btn-group" role="group">
    <!-- Ver -->
    <a href="{{ route('company_sites.show', $data->id) }}" 
       class="btn btn-outline-info btn-sm" 
       title="Ver detalles">
        <i class="bi bi-eye"></i>
    </a>
    
    <!-- Editar -->
    <a href="{{ route('company_sites.edit', $data->id) }}" 
       class="btn btn-outline-warning btn-sm" 
       title="Editar">
        <i class="bi bi-pencil"></i>
    </a>
    
    <!-- Toggle Status -->
    <form action="{{ route('company_sites.toggle-status', $data->id) }}" 
          method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" 
                class="btn btn-outline-{{ $data->status == 'active' ? 'secondary' : 'success' }} btn-sm" 
                title="{{ $data->status == 'active' ? 'Desactivar' : 'Activar' }}">
            <i class="bi bi-{{ $data->status == 'active' ? 'pause' : 'play' }}-circle"></i>
        </button>
    </form>
    
    <!-- Eliminar (solo si no tiene hijos) -->
    @if($data->childcompany_sites->count() == 0)
        <form action="{{ route('company_sites.destroy', $data->id) }}" 
              method="POST" 
              class="d-inline" 
              onsubmit="return confirm('¿Está seguro de eliminar esta ubicación?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-outline-danger btn-sm" 
                    title="Eliminar">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    @else
        <button type="button" 
                class="btn btn-outline-danger btn-sm disabled" 
                title="No se puede eliminar: tiene ubicaciones dependientes"
                disabled>
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>