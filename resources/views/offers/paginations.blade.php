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
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert" style="text-align: center">
                {{ Session::get('success')}}
            </div>
        @endif


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
    <tr>
      <th scope="row">{{ $offer -> id }}</th>
      <td>{{ $offer -> name }}</td>
      <td>{{ $offer -> price }}</td>
      <td>{{ $offer -> details }}</td>
      <td> <a href="{{ url('offers/edit/'.$offer -> id) }}" class="btn btn-success">تحرير</a></td>
      <td> <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger">delete</a></td>
      <td><img   style="border: 1px solid #063765;border-radius: 50px;background-color: #FFFFFF;"  src="{{ url('images/offers/'.$offer -> photo) }}" alt="*"width="50" height="50"> </td>
    </tr>
     @endforeach


  </tbody>
</table>
<div class="d-flex justify-content-center">
    {!! $offers -> links() !!}
</div>



    </body>
</html>
