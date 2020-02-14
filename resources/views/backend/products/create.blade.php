@extends('layouts.master')
@section('admin_content')
<div class="card">
  <div class="card-header text-white bg-success">
    <h5 class="m-0"><i class="fa fa-plus-circle fa-fw"></i> Add Product</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('products.store') }}" method="POST">
      {{ csrf_field() }}
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="Title">Title</label>
          <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group col-md-6">
          <label for="Price">Price</label>
          <input type="text" class="form-control" name="price" data-type="currency" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="Category">Category</label>
          <select class="custom-select" name="category_id">
            @foreach ($category as $cate)
            <option value="{{ $cate->id }}">{{ $cate->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="Brand">Brand</label>
          <select class="custom-select" name="brand_id">
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Content</label>
        <textarea class="form-control" name="content" rows="5"></textarea>
      </div>
      <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="1" checked>
          <label class="custom-control-label" for="customRadioInline2">Active</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="0">
          <label class="custom-control-label" for="customRadioInline1">Unactive</label>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-4 col-6">
          <a class="btn btn-secondary btn-block" href="{{ URL::previous() }}">Cancel</a>
        </div>
        <div class="col-lg-4 col-6">
          <button type="submit" class="btn btn-primary btn-block">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  function myFunction() {
    var str = document.getElementById("price").value;
    var res = str.replace(/,/g, '');  
    document.getElementById("price").value = res;
  }
</script>
@endsection