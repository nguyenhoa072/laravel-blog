@extends('layouts.master')
@section('admin_content')
<div class="mb-4">
    <h3 class="mb-3">Upload your Images <span id="counter"></span></h3>
    <form method="post" action="{{ url('/images-save') }}" enctype="multipart/form-data" class="dropzone"
        id="my-dropzone">
        {{ csrf_field() }}
        <div class="dz-message">
            <div class="message">
                <h3 class="m-0 text-muted">Thả tập tin ở đây hoặc bấm vào để tải lên.</h3>
            </div>
        </div>
        <div class="fallback">
            <input type="file" name="file" multiple>
        </div>
    </form>
    <div id="messages"></div>
</div>
<div class="card">
    <div class="card-header">File</div>
    <div class="card-body" id="list_image">
        <div class="form-row">
            @include('backend.images.index')
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/dropzone-5.7.0/dist/min/dropzone.min.js') }}"></script>
<script>
    // window.addEventListener('load', function() {
    function getData(){
        $.get({
            url: '/upload',
            success: function(data){
                $('#list_image').html(data);
            }
        })
    }    

    function deleteImage(id){
        $.post({
            url: '/images-delete',
            data: {id: id, _token: $('[name="_token"]').val()},
            dataType: 'json',
            beforeSend: function () {
                $('#'+id).prop('disabled', true);
            },
            success: function (data) {
                getData()
            }
        });
    }

    var name = "";
    var title = ''
    
    Dropzone.options.myDropzone = {
        uploadMultiple: true,
        parallelUploads: 100,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        maxFilesize: 8,
        // previewTemplate: document.querySelector('#preview').innerHTML,
        addRemoveLinks: true,
        dictRemoveFile: 'Remove file',
        dictFileTooBig: 'Your file size is too large',
        timeout: 10000,
        renameFile: function (file) {
            name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
            return name;
        },
        init: function () {          
            function displayNone() {
                $('.dz-message').css('display', 'none')
                $('#messages').css('display', 'none')
                $('#messages').html('')
            }
            this.on('sendingmultiple', function (file) {
                displayNone()
            }),  
            this.on('error', function (file, message) {    
                if(message) {
                    title = $('<div class="alert alert-danger mb-1"></div>').html('<strong>' + message + '</strong> ');
                    $("#messages").append(title);
                    file.previewElement.parentNode.removeChild(file.previewElement);
                    $('.dz-message').css('display', 'block')               
                }              
            }),
            this.on('successmultiple', function (file, response) {       
                $('.dz-message').css('display', 'block')
                $('#messages').css('display', 'block')
                response.data.map(function(item, key) {
                    if (item.success) {
                        title = $('<div class="alert alert-success mb-1"></div>').html('<strong>' + item.message + ' </strong> ' + item.title);
                        $("#messages").append(title);
                        // toastr.success(data.message)
                    } else {
                        console.log(item)
                        title = $('<div class="alert alert-danger mb-1"></div>').html('<strong>' + item.message.file + '</strong> ' + item.title);
                        $("#messages").append(title);           
                    }
                })
                getData()               
            }),
            this.on('success', function (file, response) {
                file["customName"] = file.upload.filename;
                file.previewElement.parentNode.removeChild(file.previewElement);
            })
            // Xoa image trên previewTemplate
            // this.on("removedfile", function (file) {
            //     var id = file.customName
            //     deleteImage(id)
            // })
        }
    };
    // })
</script>
@endsection