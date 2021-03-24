@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    يرجى مراجعة المدير
                </div>

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
                    <form  method="POST" id="nameconfirm" action="{{route('offers.store') }}" enctype="multipart/form-data">
                        {{-- <input name ="_token" value="{{csrf_token()}}">--}}
                        @csrf
                        <div class="form-group">
                            <label >اختر صورة</label>
                            <input type="file" class="form-control" name="photo"  >
                            @error('photo')
                            <small  class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >offre name</label>
                            <input type="text" class="form-control " name="name"  placeholder="Enter name">
                            @error('name')
                            <small  class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label >offer price</label>
                            <input type="text" class="form-control nameconfirm price" name="price" placeholder="price">

                            <small  class="form-text text-danger success_msg"> </small>
                            <small  class="form-text text-success success_msg2"> </small>

                        </div>
                        <div class="form-group">
                            <label >offer details</label>
                            <input type="text" class="form-control" name="details" placeholder="details">
                            @error('details')
                            <small  class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">save</button>
                    </form>



                </div>



            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).on('change','.nameconfirm',function (e) {
            e.preventDefault();
            var formData = new FormData($('#nameconfirm')[0]);
            $.ajax({
                type: 'post',
                url: "{{route('name.confirm') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if(data.status == true){
                        $('.success_msg').html(data.msg);
                        $('.success_msg2').html('');
                        $('.price').val('');}

                    if(data.status == false){
                        $('.success_msg').html('');
                        $('.success_msg2').html(data.msg);}

                },


            });
        });
    </script>
@stop
