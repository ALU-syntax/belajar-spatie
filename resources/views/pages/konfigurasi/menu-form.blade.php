<x-form.modal title="Form Modal">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
        
            <x-form.input name="name" value="{{ $data->name }}" label="Name" />
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Url</label>
                <input class="form-control" name="url" value="{{ $data->url }}" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input class="form-control" name="category" value="{{ $data->category }}" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Icon</label>
                <input class="form-control" name="icon" value="{{ $data->icon }}" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">No. Urut</label>
                <input class="form-control" name="orders" value="{{ $data->orders }}" type="text">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-form.radio name="level_menu" label="Level menu" inline="true" :options="['Main menu' => 'main_menu', 'Sub menu' => 'sub_menu']"/>
            </div>
        </div>

        <div id="main_menu_wrapper" class="col-md-6 {{ !$data->main_menu_id ? 'd-none' : '' }}">
            <div class="mb-3">
                <label for="" class="form-label">Main menu</label>
                <select class="form-select form-select-sm mb-3" name="main_menu" aria-label="Default select example">
                    <option selected disabled>Pilih Main Menu</option>
                    @foreach ($mainMenus as $item)
                        <option value="{{ $item->id }}" @selected($data->main_menu_id == $item->id)>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="" class="form-label d-block mb-2">Permissions</label>
                @foreach (['create', 'read', 'update', 'delete'] as $item)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="permissions[]"
                            id="inlineCheckbox1{{ $item }}" value="{{ $item }}">
                        <label class="form-check-label"
                            for="inlineCheckbox1{{ $item }}">{{ $item }}</label>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-form.modal>
