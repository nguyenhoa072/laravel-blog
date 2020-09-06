<div class="modal fade" id="edit_brand">
    <div class="modal-dialog" role="document">
        <form action="{{ route('brand.update', 'update') }}" method="POST">
            @method('PUT')
            {{ csrf_field() }}
            <input type="hidden" name="brand_id" id="brand_id_edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Brand <i class="fa fa-pencil fa-fw"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radio_status_edit_brand_active" name="status"
                                class="custom-control-input" value="1">
                            <label class="custom-control-label" for="radio_status_edit_brand_active">Active</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radio_status_edit_brand_unactive" name="status"
                                class="custom-control-input" value="0">
                            <label class="custom-control-label" for="radio_status_edit_brand_unactive">Unactive</label>
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
