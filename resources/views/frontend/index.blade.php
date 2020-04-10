<div class="row">
    @foreach ($products as $product)
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <a href="{{route('products.show', ['slug' => Str::slug($product->title), 'id' => $product->id])}}">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{$product->title}}">
            </a>
            <div class="card-body">
                <h5 class="card-title">{{$product->title}}</h5>
                <p class="card-text">{{$product->content}}</p>
                <p><b>Giá: {{$product->price}}</b></p>
            </div>
        </div>
    </div>
    @endforeach
</div>