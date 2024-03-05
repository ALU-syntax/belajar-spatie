<x-master-layout>

    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Menu</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @can('create konfigurasi/menu')
                                <a class="btn btn-primary mb-3 add" href="{{ route('konfigurasi.menu.create') }}">Tambah</a>
                            @endcan
                        </div>
                    </div>
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}

        <script>
            $('.add').on('click', function(e) {
                e.preventDefault();
                handleAjax(this.href).onSuccess(function(res) {
                    $('[name="level_menu"]').on('change', function() {
                        console.log(this.value)
                        if (this.value == 'sub_menu') {
                            $('#main_menu_wrapper').removeClass('d-none')
                        } else {
                            $('#main_menu_wrapper').addClass('d-none')
                        }
                    })
                    handleFormSubmit('#form_action')
                        .onSuccess(function(res) {

                        }).setDataTable('menu-table')
                        .init();
                }).excute();

            });
        </script>
    @endpush
</x-master-layout>
