@extends('layouts.app')


@section('content')
    <div class="container" >
        <div class="alert alert-success" id="success_msg" style="display:none;">
            تم التحديث بنجاح
        </div>

        <div class="flex-center position-ref full-height">



            <div class="content">
                <div class="title m-b-md">
                    create add
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success')}}
                    </div>
                @endif
                <br>
                <form  method="POST" id="offerFormUpdate" action="" enctype="multipart/form-data">
                    {{-- <input name ="_token" value="{{csrf_token()}}">--}}
                    @csrf
                    <div class="form-group">
                        <label >اختر صورة</label>
                        <input type="file" class="form-control" name="photo"  >
                        <small  id="photo_error" class="form-text text-danger"></small>
                    </div>
                    <input hidden="hidden" type="text" class="form-control" value="{{$offer -> id}}" name="offer_id"  >

                    <div class="form-group">
                        <label >offre name</label>
                        <input type="text" class="form-control" value="{{$offer -> name}}" name="name"  placeholder="Enter name">
                        <small id="name_error"  class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label >offer price</label>
                        <input type="text" class="form-control" value="{{$offer -> price}}" name="price" placeholder="price">
                        <small id="price_error" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label >offer details</label>
                        <input type="text" class="form-control" value="{{$offer -> details}}" name="details" placeholder="details">
                        <small id="details_error" class="form-text text-danger"></small>
                    </div>

                    <button id="update_offer" class="btn btn-primary">تحديث</button>
                </form>



            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).on('click','#update_offer',function (e) {
            e.preventDefault();
            $('#photo_error').text('');
            $('#name_error').text('');
            $('#price_error').text('');
            $('#details_error').text('');
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype:'multipart/form-data',
                url: "{{route('ajax.offers.update') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if(data.status == true)
                        $('#success_msg').show();
                },
                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                },

            });
        });



    </script>

@stop
