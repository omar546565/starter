@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              video Viewer ({{ $video -> viewers }})

            </div>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/GVNDbTwOSiw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection
