@extends('layouts.master')
@section('admin_content')
@include('backend.brand.create')
@include('backend.brand.edit')
@include('backend.brand.delete')
@if (($message = Session::get('message_warning')) || ($message = Session::get('message_success')))
<div
  class="alert @if(Session::get('message_warning')) alert-warning @else alert-success @endif alert-dismissible fade show"
  role="alert">
  {{ $message }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="row mb-4">
  <div class="col-lg-4 col-6 mr-auto">
    <a href="{{ route('products.create') }}" class="btn btn-success btn-block" data-toggle="modal"
      data-target="#create_brand">
      <i class="fa fa-plus-circle fa-fw"></i> Create Brand
    </a>
  </div>
  <div class="col-lg-4 col-6">
    <input type="text" class="form-control" placeholder="Search">
  </div>
</div>
<div class="card mt-4">
  <div class="card-header">
    <h5 class="m-0">Products</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover" data-toggle="dataTable" data-form="deleteForm">
        <thead>
          <tr>
            <th scope="col" width="1%">#</th>
            <th scope="col">Title</th>
            <th scope="col">Status</th>
            <th scope="col" width="1%">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($brands as $brand)
          <tr>
            <th scope="row">{{ $brand->id }}</th>
            <td>{{ $brand->title }}</td>
            <td>
              <?php 
              if($brand->status) {  
            ?>
              <a href="{{ url('/unactive-brand/'.$brand->id) }}">
                <span class='badge badge-success'>ON</span></a>
              <?php
              } else {
            ?>
              <a href="{{ url('/active-brand/'.$brand->id) }}">
                <span class='badge badge-secondary'>OFF</span></a>
              <?php
              }               
            ?>
            </td>
            <td>
              <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit_brand"
                  data-title="{{$brand->title}}" data-description="{{$brand->description}}"
                  data-status="{{$brand->status}}" data-id={{$brand->id}}>Edit</button>
                <button type="submit" class="btn btn-outline-danger" data-id={{$brand->id}} data-toggle="modal"
                  data-target="#delete_brand">Delete</button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {!! $brands->links() !!}
  </div>
</div>
<script>
  $('#edit_brand').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) 
      var title = button.data('title') 
      var description = button.data('description') 
      var brand_id = button.data('id') 
      var status = button.data('status')
      var modal = $(this)     

      if(status) {
        document.getElementById('radio_status_edit_brand_active').checked = true;
      } else {
        document.getElementById('radio_status_edit_brand_unactive').checked = true;
      }  

      modal.find('#title').val(title);
      modal.find('#description').val(description);
      modal.find('#brand_id_edit').val(brand_id);
  })

  $('#delete_brand').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) 
    var brand_id = button.data('id') 
    var modal = $(this)

    modal.find('#brand_id_delete').val(brand_id);
  })

</script>
@endsection