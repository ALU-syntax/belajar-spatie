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

            function handleCheckMenu(){
                $('.parent').on('click', function(){
                    const childs = $(this).parents('tr').find('.child')
                    childs.prop('checked', this.checked)
                })

                $('.child').on('click', function(){
                    const parent = $(this).parents('tr')
                    const childs = parent.find('.child')
                    const checked = parent.find('.child:checked')

                    parent.find('.parent').prop('checked', childs.length == checked.length)
                })

                $('.parent').each(function(){
                    const parent = $(this).parents('tr')
                    const childs = parent.find('.child')
                    const checked = parent.find('.child:checked')

                    parent.find('.parent').prop('checked', childs.length == checked.length)
                })
            }
            handleAction(datatable, function(){
                handleCheckMenu()

                $('.copy-role').on('change', function(){
                    console.log(this.value)
                    handleAjax(`{{ url('konfigurasi/akses-role') }}/${this.value}/role`)
                    .onSuccess(function(res){
                        $('#menu_permissions').html(res)
                        handleCheckMenu()
                    }, false).excute();
                })
            });
            handleDelete(datatable);
        </script>
    @endpush
</x-master-layout>
