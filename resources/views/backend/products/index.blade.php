@extends('layouts.master')

@section('admin_content')

@include('backend.products.delete')

@include('backend.message')

<div class="row mb-4">
    <div class="col-lg-4 col-6 mr-auto">
        <a href="{{ route('products.create') }}" class="btn btn-success btn-block">
            <i class="fa fa-plus-circle fa-fw"></i> Create Product
        </a>
    </div>
    <div class="col-lg-4 col-6">
        <form action="/search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Button</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="m-0">Products</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{-- <form action="{{ url('/delete-multiple') }}" method="POST"> --}}
            <table class="table table-bordered table-striped table-hover" data-toggle="dataTable"
                data-form="deleteForm">
                <thead>
                    <tr>
                        <th scope="col" width="1%">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price (VNĐ)</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th scope="col" width="1%">
                            <button id="bulk_delete" data-toggle="modal" data-target="#modal_delete_product"
                                type="submit" class="btn btn-danger btn-sm" disabled>Delete</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <th><input type="checkbox" name="ids[]" class="btSelectItem" value="{{ $product->id }}"></th>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->category_title }}</td>
                        <td>{{ $product->brand_title }}</td>
                        <td>{{ number_format($product->price, 0) }}</td>
                        <td><img src="{{asset($product->image)}}" alt="" height="30"></td>
                        <td>
                            <?php
                            if ($product->status) {
                            ?>
                            <a href="{{ url('/unactive-product/'.$product->id) }}"><span
                                    class='badge badge-success'>ON</span></a>
                            <?php
                            } else {
                            ?>
                            <a href="{{ url('/active-product/'.$product->id) }}"><span
                                    class='badge badge-secondary'>OFF</span></a>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            {{-- <form action="{{ route('products.destroy', $product->id) }}" method="POST"> --}}
                            <div class="btn-group btn-group-sm" role="group">
                                <a class="btn btn-outline-warning"
                                    href="{{ route('products.edit', $product->id) }}">Edit</a>
                                {{-- <button id="bulk_delete" type="submit" class="btn btn-outline-danger" disabled>Delete</button> --}}
                            </div>
                            @csrf
                            {{-- @method('DELETE') --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- </form> --}}
        </div>
        {!! $products->links() !!}
    </div>
</div>

@endsection

@section('script')

<script type="application/javascript">

    window.addEventListener('load', function() {

        $('.btSelectItem').click(function() {
            if ($('.btSelectItem:checked').length) {
                $('button').prop("disabled", false);
                console.log($('.btSelectItem:checked').length);
            } else {
                $('button').prop("disabled", true);
            }
        });

        $("#submit_delete_product").click(function() {
            var id = [];
            $('.btSelectItem:checked').each(function() {
                id.push($(this).val());
            });
            $.ajax({
                url: "{{ route('ajaxdata.massremove') }}",
                method: "get",
                data: {
                    id: id
                },
                success: function(data) {
                    // location.reload();
                    console.log(data)
                }
            });
        });

    })

</script>

@endsection