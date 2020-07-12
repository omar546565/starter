<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                  <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">  {{ $properties['native'] }}</a>
                </li>
                @endforeach
              </ul>
              @if (Route::has('login'))
              <div class="top-right links">
                  @auth
                      <a href="{{ url('/home') }}">Home</a>
                  @else
                      <a href="{{ route('login') }}">Login</a>

                      @if (Route::has('register'))
                          <a href="{{ route('register') }}">Register</a>
                      @endif
                  @endauth
              </div>
          @endif
        </nav>
        <div class="flex-center position-ref full-height">



            <div class="content">
                <div class="title m-b-md">
                   تحرير العرض
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                   {{ Session::get('success')}}
                    </div>
                @endif
                  <br>
                <form  method="POST" action="{{route('offers.update',$offer -> id)}}" enctype="multipart/form-data">
                 {{-- <input name ="_token" value="{{csrf_token()}}">--}}
                     @csrf
                    <div class="form-group">
                      <label >offre name</label>
                      <input type="text" class="form-control" name="name" value="{{ $offer -> name }}" placeholder="Enter name">
                      @error('name')
                      <small  class="form-text text-danger">{{$message}}</small>
                      @enderror
                      </div>
                    <div class="form-group">
                      <label >offer price</label>
                      <input type="text" class="form-control" name="price" value="{{ $offer -> price }}" placeholder="price">
                      @error('price')
                      <small  class="form-text text-danger">{{$message}}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label >offer details</label>
                        <input type="text" class="form-control" name="details" value="{{ $offer -> details }}" placeholder="details">
                        @error('details')
                      <small  class="form-text text-danger">{{$message}}</small>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label >images</label>
                        <img   style="border: 1px solid #063765;border-radius: 50px;background-color: #FFFFFF;"  src="{{ url('images/offers/'.$offer -> photo) }}" alt="*"width="50" height="50">
                        <input type="file" class="form-control" name="photo"  >
                        @error('photo')
                        <small  class="form-text text-danger">{{$message}}</small>
                        @enderror
                      </div>

                    <button type="submit" class="btn btn-success">update</button>
                  </form>



            </div>
        </div>
    </body>
</html>
