@extends('layouts.master')
@section('admin_content')
<div class="card">
  <div class="card-header text-white bg-success">
    <h5 class="m-0"><i class="fa fa-pencil fa-fw"></i> Edit Product</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('products.update',$product->id) }}" method="POST">

      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
      <input type="text" class="form-control" name="title" value="{{ $product->title }}" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Content</label>
      <textarea class="form-control" name="content" rows="5">{{ $product->content }}</textarea>
      </div>
      <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="1" @if ($product->status) checked @endif>
          <label class="custom-control-label" for="customRadioInline2">Active</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="0" @if (!$product->status) checked @endif>
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
@endsection