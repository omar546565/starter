@extends('layouts.app')


@section('content')
  <div class="container" >
      <div class="alert alert-success" id="success_msg" style="display:none;">
      </div>

    <div class="flex-center position-ref full-height">



        <div class="content">
            <div class="title m-b-md">
               الخدمات
            </div>

            <br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">الاسم</th>


                </tr>
                </thead>
                <tbody>
                @if(isset($services)&& $services -> count() > 0)
                    @foreach($services as $service)
                <tr>
                    <th scope="row">{{$service -> id}}</th>
                    <td>{{$service -> name}}</td>

                </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <br><br><br>
            <form  method="POST" action="{{route('save.doctor.services')}}" >
                {{-- <input name ="_token" value="{{csrf_token()}}">--}}
                @csrf

                <div class="form-group">
                    <label >اختر طبيب</label>
                  <select class="form-control" name="doctor_id">
                     @foreach($doctors as $doctor)
                     <option value="{{$doctor -> id}}"> {{$doctor -> name}}</option>
                     @endforeach
                 </select>
                </div>
                <div class="form-group">
                    <label >اختر الخدمات</label>
                     <select class="form-control" name="servicesIds[]" multiple>
                        @foreach($allservices as $allservice)
                            <option value="{{$allservice -> id}}"> {{$allservice -> name}}</option>
                        @endforeach

                    </select>
                </div>

                <button type="submit" class="btn btn-primary">save</button>
            </form>

        </div>
    </div>
  </div>


    @stop
