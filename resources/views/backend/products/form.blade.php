@extends('layouts.master')

@section('admin_content')

<div class="card">
    <div class="card-header text-white bg-success">
        <h5 class="m-0"><i class="fa fa-pencil fa-fw"></i> {{ isset($product->id) ? 'Edit Product' : 'Create Product' }}
        </h5>
    </div>
    <div class="card-body">
        <form onsubmit="myFunction()" method="POST" enctype="multipart/form-data"
            action="<?= isset($product->id) ? route('products.update', $product->id) : route('products.store') ?>">
            @csrf
            {{ isset($product->id) ? method_field('put') : "" }}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ @$product->title }}">
                    @error('title')
                    <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="Price">Price</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                        value="{{ number_format(@$product->price, 0) }}" data-type="currency">
                    @error('price')
                    <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Category">Category</label>
                    <select class="custom-select" name="category_id">
                        @foreach ($category as $cate)
                        @if(@$product->category_id === $cate->id)
                        <option selected value="{{ $cate->id }}">{{ $cate->title }}</option>
                        @else
                        <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Brand</label>
                    <select class="custom-select" name="brand_id">
                        @foreach ($brands as $brand)
                        @if(@$product->brand_id === $brand->id)
                        <option selected value="{{ $brand->id }}">{{ $brand->title }}</option>
                        @else
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image"
                            id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                        @error('image')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mt-3"><img src="{{asset(@$product->image)}}" alt="" height="200"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Content</label>
                <textarea class="form-control" name="content" rows="5">{{ @$product->content }}</textarea>
            </div>
            <div class="form-group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="status" class="custom-control-input" value="1"
                        <?= !isset($product->status) || @$product->status == '1' ? 'checked' : '' ?>>
                    <label class="custom-control-label" for="customRadioInline2">Active</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="status" class="custom-control-input" value="0"
                        @if(@$product->status == '0') checked @endif>
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

@section('script')

<script type="application/javascript">
    function myFunction() {
        var str = document.getElementById("price").value;
        var price = str.replace(/,/g, '');  
        document.getElementById("price").value = price;
    }

    window.addEventListener('load', function() {      
        document.querySelector('.custom-file-input').addEventListener('change',function(e){
            var fileName = document.getElementById("image").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    })
</script>

@endsection