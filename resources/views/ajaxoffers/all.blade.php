@extends('layouts.app')
@section('content')
    <div class="container" >
        <div class="alert alert-danger" id="success_msg" style="display:none;">
            تم الحذف بنجاح
        </div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">price</th>
        <th scope="col">details</th>
        <th scope="col">edit</th>
        <th scope="col">delete</th>
        <th scope="col">image</th>
    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr class="offerRow{{ $offer -> id }}">
            <th scope="row">{{ $offer -> id }}</th>
            <td>{{ $offer -> name }}</td>
            <td>{{ $offer -> price }}</td>
            <td>{{ $offer -> details }}</td>
            <td> <a href="{{ url('offers/edit/'.$offer -> id) }}" class="btn btn-success">تحرير</a>
                <a href="{{ route('ajax.offers.edit',$offer -> id) }}" class="btn btn-success">تحرير أجاكس</a></td>
            <td> <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger">delete</a>
                  <a href="" offer_id="{{$offer -> id}}"  class="delete_btn btn btn-danger">حذف أجاكس</a></td>
            <td><img   style="border: 1px solid #063765;border-radius: 50px;background-color: #FFFFFF;"  src="{{ url('images/offers/'.$offer -> photo) }}" alt="*"width="50" height="50"> </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop
@section('scripts')
    <script>
        $(document).on('click','.delete_btn',function (e) {
            e.preventDefault();
         var offer_id =   $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                enctype:'multipart/form-data',
                url: "{{route('ajax.offers.delete') }}",
                data: {
                   '_token': "{{csrf_token()}}",
                   'id' : offer_id
                },

                success: function (data) {

                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();


                },
                error: function (reject) {

                },

            });
        });



    </script>

@stop
