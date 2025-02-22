@foreach ($data->getPermissionNames() as $permission)
    <span class="badge badge-primary">{{ $permission }}</span>
@endforeach
@can('edit_roles')
    <a class="text-primary" href="{{ route('roles.edit', $data->id) }}">.......</a>
@endcan
