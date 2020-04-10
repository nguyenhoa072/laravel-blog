@extends('layouts.app')

@section('content')
<div class="container">
    @include('frontend.brand.index')
    <div class="row mb-3 align-items-center">
        <div class="col-6 mr-auto">
            <h3 class="m-0">Danh sách sản phẩm</h3>
        </div>
        <div class="col-3">
            <form action="" method="GET">
                <select class="custom-select" name="sort" id="sort" onchange="sapXep()">
                    <option {{@$sort === "none" ? 'selected' : ''}} value="none">Sắp xếp</option>
                    <option {{@$sort === "desc" ? 'selected' : ''}} value="desc">Giá cao đến thấp</option>
                    <option {{@$sort === "asc" ? 'selected' : ''}} value="asc">Giá thấp đến cao</option>
                </select>
            </form>
        </div>
    </div>
    <div id="list_product">
        @include('frontend.index')
    </div>
</div>
@endsection
@section('script')
<script>
    function sapXep() {

        // var action = $('#sort').val()
        // $("form").attr("action", "/?" + action);
        // $('form').submit();

        $.ajax({
            url: '/',
            type: 'get',
            data: {
                sort: $('select[name="sort"]').val()
            },
            beforeSend: function () {
                $('.loading').css('display', 'block')
            },
            success: function(data) { 
                $("#list_product").html(data);
            },            
            complete: function () {
                setTimeout(() => {
                    $('.loading').css('display', 'none')
                }, 1000);                
            }
        });
    }

</script>
@endsection