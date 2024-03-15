<x-form.modal title="Form Modal" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-12">
            <h5>Role: {{ $data->name }}</h5>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $mm)
                            <tr>
                                <td>{{ $mm->name }}</td>
                                <td>
                                    @foreach ($mm->permissions as $permission)
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input" name="permissions[]"
                                                value="{{ $permission->name }}" @checked($data->hasPermissionTo($permission->name))
                                                type="checkbox" id="permission-{{ $mm->id . '-' . $permission->id }}">
                                            <label class="form-check-label"
                                                for="{{ $mm->id . '-' . $permission->id }}">{{ explode(' ', $permission->name)[0] }}</label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            @foreach ($mm->subMenus as $sm)
                                <tr>
                                    <td>&nbsp; &nbsp; &nbsp; &nbsp; {{ $sm->name }}</td>
                                    <td>
                                        @foreach ($sm->permissions as $permission)
                                            <div class="form-check form-switch form-check-inline">
                                                <input class="form-check-input" name="permissions[]"
                                                    value="{{ $permission->name }}" @checked($data->hasPermissionTo($permission->name))
                                                    type="checkbox" id="permission-{{ $sm->id . '-' . $permission->id }}">
                                                <label class="form-check-label"
                                                    for="{{ $sm->id . '-' . $permission->id }}">{{ explode(' ', $permission->name)[0] }}</label>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-form.modal>
