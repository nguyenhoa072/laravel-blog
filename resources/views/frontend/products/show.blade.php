@extends('layouts.app')

@section('content')
<div class="container">
  <h3>{{$product->title}}</h3>
  <p><b>Giá: {{$product->price}}</b></p>
  <p><img src="{{asset($product->image)}}" alt="" class="img-fluid"></p>
  <p>{{$product->content}}</p>
</div>
@endsection