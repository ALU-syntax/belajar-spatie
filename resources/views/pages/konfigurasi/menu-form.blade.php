<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form id="form_action" action="{{ $action }}" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" name="name" value="{{ $data->name }}" type="text">
                        </div>
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

                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div></form>
    </div>
</div>