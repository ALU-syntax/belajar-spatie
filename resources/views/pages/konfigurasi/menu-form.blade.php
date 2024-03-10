<x-form.modal title="Form Modal">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-form.input name="name" value="{{ $data->name }}" label="Name" />
        </div>
        <div class="col-md-6">
            <x-form.input name="url" value="{{ $data->url }}" label="URL" />
        </div>
        <div class="col-md-6">
            <x-form.input name="category" value="{{ $data->category }}" label="Category" />
        </div>
        <div class="col-md-6">
            <x-form.input name="icon" value="{{ $data->icon }}" label="Icon" />
        </div>
        <div class="col-md-6">
            <x-form.input name="orders" value="{{ $data->orders }}" label="No. Urut" />
        </div>
        <div class="col-md-6">
                <x-form.radio name="level_menu" label="Level menu" value="{{ $data->main_menu_id ? 'sub_menu' : 'main_menu' }}" inline="true" :options="['Main menu' => 'main_menu', 'Sub menu' => 'sub_menu']"/>
        </div>

        <div id="main_menu_wrapper" class="col-md-6 {{ !$data->main_menu_id ? 'd-none' : '' }}">
            <x-form.select id="main_menu" name="main_menu" value="{{ $data->main_menu_id }}" label="Main menu" placholder="Pilih Main Menu"
                :options="$mainMenus" />
        </div>

        @if(!$data->id)
        
        <div class="col-12">
            <div class="mb-3">
                <label for="" class="form-label d-block mb-2">Permissions</label>
                @foreach (['create', 'read', 'update', 'delete'] as $item)
                <x-form.checkbox name="permissions[]" id="{{ $item }}_permissions" value="{{ $item }}" label="{{ $item }}"/>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</x-form.modal>
