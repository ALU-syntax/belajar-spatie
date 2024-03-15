@foreach ($menus as $mm)
    <tr>
        <td>{{ $mm->name }}</td>
        <td>
            @foreach ($mm->permissions as $permission)
                <div class="form-check form-switch form-check-inline">
                    <input class="form-check-input" name="permissions[]" value="{{ $permission->name }}"
                        @checked($data->hasPermissionTo($permission->name)) type="checkbox"
                        id="permission-{{ $mm->id . '-' . $permission->id }}">
                    <label class="form-check-label"
                        for="{{ $mm->id . '-' . $permission->id }}">{{ explode(' ', $permission->name)[0] }}</label>
                </div>
            @endforeach
        </td>
    </tr>
    @foreach ($mm->subMenus as $sm)
        <tr>
            <td>&nbsp; &nbsp; &nbsp; &nbsp; <x-form.checkbox id="parent{{ $mm->id.$sm->id }}" name="parent" label="{{ $sm->name }}" class="parent" /></td>
            {{-- <td>&nbsp; &nbsp; &nbsp; &nbsp; {{ $sm->name }}</td> --}}
            <td>
                @foreach ($sm->permissions as $permission)
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input child" name="permissions[]" value="{{ $permission->name }}"
                            @checked($data->hasPermissionTo($permission->name)) type="checkbox"
                            id="permission-{{ $sm->id . '-' . $permission->id }}">
                        <label class="form-check-label"
                            for="{{ $sm->id . '-' . $permission->id }}">{{ explode(' ', $permission->name)[0] }}</label>
                    </div>
                @endforeach
            </td>
        </tr>
    @endforeach
@endforeach
