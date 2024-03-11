<x-master-layout>

    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Role</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @can('create konfigurasi/roles')
                                <a class="btn btn-primary mb-3 add" href="{{ route('konfigurasi.roles.create') }}">Add</a>
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
            const datatable = 'role-table';

            $('.add').on('click', function(e) {
                e.preventDefault();
                handleAjax(this.href)
                    .onSuccess(function(res) {
                        handleFormSubmit('#form_action')
                            .setDataTable(datatable)
                            .init();
                    })
                    .excute();

            });

            $('#' + datatable).on('click', '.action', function(e) {
                e.preventDefault();
                handleAjax(this.href).onSuccess(function(res) {
                    handleFormSubmit('#form_action')
                        .setDataTable(datatable)
                        .init();
                }).excute();
            });

            $('#' + datatable).on('click', '.delete', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        handleAjax(this.href, 'delete').onSuccess(function(res) {
                            showToast(res.status, res.message)
                            window.LaravelDataTables[datatable].ajax.reload()
                        }, false).excute();
                    }
                })

            });
        </script>
    @endpush
</x-master-layout>
