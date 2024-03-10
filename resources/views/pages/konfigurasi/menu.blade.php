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
                                <a class="btn btn-primary mb-3 add" href="{{ route('konfigurasi.menu.create') }}">Add</a>
                            @endcan
                            @can('sort konfigurasi/menu')
                                <a class="mb-3 btn btn-info sort" href="{{ route('konfigurasi.menu.sort') }}">Sort Menu</a>
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
            function handleMenuChange() {
                $('[name="level_menu"]').on('change', function() {
                    console.log(this.value)
                    if (this.value == 'sub_menu') {
                        $('#main_menu_wrapper').removeClass('d-none')
                    } else {
                        $('#main_menu_wrapper').addClass('d-none')
                    }
                });
            }

            $('.sort').on('click', function(e){
                e.preventDefault();

                handleAjax(this.href, 'put')
                .onSuccess(function(res){
                    window.location.reload()
                }, false)
                .excute()
            })

            $('.add').on('click', function(e) {
                e.preventDefault();
                handleAjax(this.href)
                .onSuccess(function(res) {
                    handleMenuChange();
                    handleFormSubmit('#form_action')
                    .setDataTable('menu-table')
                    .init();
                })
                .excute();

            });

            $('#menu-table').on('click', '.action', function(e) {
                e.preventDefault();
                handleAjax(this.href).onSuccess(function(res) {
                    handleMenuChange()
                    handleFormSubmit('#form_action')
                        .setDataTable('menu-table')
                        .init();
                }).excute();
            });
        </script>
    @endpush
</x-master-layout>
