@extends('layouts.master')
@section('admin_content')
<div class="row mb-4">
  <div class="col-lg-4 col-6 mr-auto">
    <a href="{{ route('products.create') }}" class="btn btn-success btn-block"><i class="fa fa-plus-circle fa-fw"></i> Add Product</a>
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
          @foreach ($products as $product)
          <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->title }}</td>
            <td>
              <?php 
              if($product->status) {  
            ?>
              <a href="{{ url('/unactive-category-product/'.$product->id) }}"><span
                  class='badge badge-success'>ON</span></a>
              <?php
              } else {
            ?>
              <a href="{{ url('/active-category-product/'.$product->id) }}"><span
                  class='badge badge-secondary'>OFF</span></a>
              <?php
              }               
            ?>
            </td>
            <td>
              <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                <div class="btn-group btn-group-sm" role="group">
                  <a class="btn btn-outline-warning" href="{{ route('products.edit', $product->id) }}">Edit</a>
                  <button type="submit" class="btn btn-outline-danger">Delete</button>
                </div>
                @csrf
                @method('DELETE')
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {!! $products->links() !!}
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
@endsection