@extends('layouts.master')
@section('admin_content')
<div class="card">
  <div class="card-header text-white bg-success">
    <h5 class="m-0"><i class="fa fa-plus-circle fa-fw"></i> Create Category</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('category.store') }}" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
        @error('title')
        <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
          rows="5"></textarea>
        @error('description')
        <div class="invalid-feedback"> {{ $message }} </div>
        @enderror
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
      <a class="btn btn-secondary" href="{{ URL::to('category') }}">Cancel</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>
@endsection