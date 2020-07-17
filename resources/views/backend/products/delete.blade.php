<div class="modal fade" id="modal_delete_product">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="text-danger">Are you sure you, want to delete?</p>
			</div>
			<div class="modal-footer">
				<a href="{{ URL::previous() }}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
				<button id="submit_delete_product" type="submit" class="btn btn-danger">Delete</button>
			</div>
		</div>
	</div>
</div>