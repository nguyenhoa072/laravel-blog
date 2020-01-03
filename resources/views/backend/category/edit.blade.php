@extends('layouts.master')
@section('admin_content')
<div class="card">
  <div class="card-header text-white bg-success">
    <h5 class="m-0"><i class="fa fa-pencil fa-fw"></i> Edit Category</h5>
  </div>
  <div class="card-body">
    @foreach ($edit_category as $item)       
    <form action="{{ url('/update-category/'.$item->id) }}" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $item->title }}" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea class="form-control" name="description" rows="5">{{ $item->description }}</textarea>
      </div>
      <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="1" @if ($item->status) checked @endif >
          <label class="custom-control-label" for="customRadioInline2">Active</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="0" @if (!$item->status) checked @endif>
          <label class="custom-control-label" for="customRadioInline1">Unactive</label>
        </div>        
      </div>     
      <a class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
    @endforeach
  </div>
</div>
@endsection