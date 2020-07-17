<div class="modal fade" id="delete_brand">
	<div class="modal-dialog" role="document">
		<form action="{{ route('brand.destroy', 'delete') }}" method="post">
			@csrf @method('delete')
			<input type="hidden" name="brand_id" id="brand_id_delete" value="">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Brand</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p class="text-danger">Are you sure you, want to delete?</p>
				</div>
				<div class="modal-footer">
					<a href="{{ URL::previous() }}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</div>
		</form>
	</div>
</div>