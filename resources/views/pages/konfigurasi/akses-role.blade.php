<x-master-layout>

    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Akses Role</h4>
                </div>
                <div class="card-body">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}

        <script>
            const datatable = 'role-table';

            handleAction(datatable, function(){
                $('.copy-role').on('change', function(){
                    console.log(this.value)
                    handleAjax(`{{ url('konfigurasi/akses-role') }}/${this.value}/role`)
                    .onSuccess(function(res){
                        $('#menu_permissions').html(res)
                    }, false).excute();
                })
            });
            handleDelete(datatable);
        </script>
    @endpush
</x-master-layout>