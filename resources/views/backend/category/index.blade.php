@extends('layouts.master')
@section('admin_content')
@include('modal')
<div class="row mb-4">
  <div class="col-lg-4 col-6 mr-auto">
    <a href="{{ route('category.create') }}" class="btn btn-success btn-block"><i class="fa fa-plus-circle fa-fw"></i>
      Create Category</a>
  </div>
  <div class="col-lg-4 col-6">
    <input type="text" class="form-control" placeholder="Search">
  </div>
</div>
@if (($message = Session::get('message_warning'))
|| ($message = Session::get('message_success'))
|| ($message = Session::get('message_danger')))
<div class="alert 
  @if(Session::get('message_warning')) alert-warning 
  @elseif(Session::get('message_success')) alert-success 
  @elseif(Session::get('message_danger')) alert-danger 
  @endif alert-dismissible fade show">
  {{ $message }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="card mt-4">
  <div class="card-header">
    <h5 class="m-0">Category Product</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover" data-toggle="dataTable" data-form="deleteForm">
        <thead>
          <tr>
            <th scope="col" width="1%">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col" width="1%">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($category as $item)
          <tr>
            <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->title }}</td>
            <td>{{ $item->description }}</td>
            <td>
              <?php 
              if($item->status) {  
            ?>
              <a href="{{ url('category/deactivated/'.$item->id) }}"><span class='badge badge-success'>ON</span></a>
              <?php
              } else {
            ?>
              <a href="{{ url('category/activated/'.$item->id) }}"><span class='badge badge-secondary'>OFF</span></a>
              <?php
              }               
            ?>
            </td>
            <td>
              <div class="btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-warning" href="{{ route('category.edit', $item->id) }}">Edit</a>
                {{-- <a class="btn btn-outline-danger btn-sm" href="{{ url('/delete-category-product/'.$item->id) }}">Delete</a>
                --}}
                <button class="btn btn-outline-danger" data-toggle="modal" data-id="{{ $item->id }}"
                  data-target="#delete">Delete</button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {!! $category->links() !!}
  </div>
</div>
<script type="application/javascript">
  $(document).ready(function(){
    $('.btn-outline-danger').click(function() {
      var id = $(this).attr('data-id');
      var url = $(this).attr('data-url');
      
      $('.modal-form').attr("action", url);
      $('body').find('.modal-form .modal-body').append('<input id="id" name="id" type="hidden" value="'+ id +'">');
    });

    $("#delete").on('hide.bs.modal', function () {
      $('body').find('.modal-form').find("input#id").remove();
    });
  });
</script>
@endsection