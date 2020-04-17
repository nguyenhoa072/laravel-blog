<div class="form-row">
    @if(count($photos)>0)
        @foreach($photos as $photo)
        <div class="col-2 mb-2">
            <img src="{{ $photo->url . "/" . $photo->resized_name }}" class="img-fluid border">
            <button class="btn btn-danger btn-sm" onclick="deleteImage(this.id)" id="{{$photo->id}}">Xoa</button>
        </div>
        @endforeach 
    @else
        <p>Không có dữ liệu.</p>   
    @endif
</div>