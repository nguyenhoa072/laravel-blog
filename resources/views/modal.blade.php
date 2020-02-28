<div class="modal" id="delete">
  <div class="modal-dialog" role="document">
    <form action="{{ route('category.destroy', 'delete') }}" method="post" class="modal-form">
      @csrf @method('delete')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          {{-- <input type="hidden" name="category_id" id="cat_id" value=""> --}}
          <p class="text-danger">Are you sure you, want to delete?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>