@extends('layouts.master')
@section('admin_content')
@include('modal')
<div class="row mb-4">
  <div class="col-lg-4 col-6 mr-auto">
    <a href="{{ url('/add-category') }}" class="btn btn-success btn-block"><i class="fa fa-plus-circle fa-fw"></i> Create Category</a>
  </div>
  <div class="col-lg-4 col-6">
    <input type="text" class="form-control" placeholder="Search">
  </div>
</div>
<?php
$message_title = session()->get('message_title');
$message_warning = session()->get('message_warning');
$message_success = session()->get('message_success');
$message_danger = session()->get('message_danger');

if($message_warning){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{ $message_warning }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
  session()->put('message_warning', null);
}

if($message_danger){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ $message_danger }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
  session()->put('message_danger', null);
}

if($message_success){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <h5 class="alert-heading">{{ $message_title }}</h5>
  <hr>
  <p class="m-0">{{ $message_success }}</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
  session()->put('message_success', null);
  session()->put('message_title', null);
}
?>
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
            <th scope="col">Status</th>
            <th scope="col" width="1%">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($category as $item)
          <tr>
            <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->title }}</td>
            <td>
              <?php 
              if($item->status) {  
            ?>
              <a href="{{ url('/unactive-category/'.$item->id) }}"><span class='badge badge-success'>ON</span></a>
              <?php
              } else {
            ?>
              <a href="{{ url('/active-category/'.$item->id) }}"><span class='badge badge-secondary'>OFF</span></a>
              <?php
              }               
            ?>
            </td>
            <td>
              <div class="btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-warning" href="{{ url('/edit-category/'.$item->id) }}">Edit</a>
                {{-- <a class="btn btn-outline-danger btn-sm" href="{{ url('/delete-category-product/'.$item->id) }}">Delete</a>
                --}}
                <button class="btn btn-outline-danger" data-url="{{ url('delete-category', $item->id) }}"
                  data-toggle="modal" data-id="{{ $item->id }}" data-target="#delete">Delete</button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</div>
<script>
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