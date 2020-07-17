<div class="row">
	@foreach ($brand as $item)
	<div class="col-2 mb-4">
		<a href="{{route('brand', ['slug' => Str::slug($item->title), 'id' => $item->id])}}"
			class="btn btn-primary btn-block">{{$item->title}}</a>
	</div>
	@endforeach
</div>