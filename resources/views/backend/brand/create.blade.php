<div class="modal fade" id="create_brand">
    <div class="modal-dialog" role="document">
        <form action="{{ route('brand.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control" name="description" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radio_status_create_brand_active" name="status"
                                class="custom-control-input" value="1" checked>
                            <label class="custom-control-label" for="radio_status_create_brand_active">Active</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radio_status_create_brand_unactive" name="status"
                                class="custom-control-input" value="0">
                            <label class="custom-control-label"
                                for="radio_status_create_brand_unactive">Unactive</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>