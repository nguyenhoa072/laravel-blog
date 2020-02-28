@extends('layouts.app')

@section('content')
<div class="container">
  @include('frontend.brand.index')
  <div class="row mb-3 align-items-center">
    <div class="col-6 mr-auto">
      <h3 class="m-0">Danh sách sản phẩm</h3>
    </div>
    <div class="col-3">
      <form action="" method="GET">
        <select class="custom-select" name="sort_price" id="sort_price">
          <option {{@$sortprice === "none" ? 'selected' : ''}} value="none">Sắp xếp</option>
          <option {{@$sortprice === "desc" ? 'selected' : ''}} value="desc">Giá cao đến thấp</option>
          <option {{@$sortprice === "asc" ? 'selected' : ''}} value="asc">Giá thấp đến cao</option>
        </select>
      </form>
    </div>
  </div>
  <div id="result_container"></div>
  <div class="row">
    @foreach ($products as $product)
    <div class="col-md-4 mb-4">
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
</div>
@endsection