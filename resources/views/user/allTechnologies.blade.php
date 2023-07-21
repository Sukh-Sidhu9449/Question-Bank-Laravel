@extends('newuser-layout.template')
@section('newuser-main-content')
<div class="container div2">
    <div class="py-2 px-2">
        <div class="row">
            @isset($allTechnologies)
                @foreach ($allTechnologies as $f)
                    <div class="col-lg-4 col-md-6 ">
                        <div class="card-outer rounded my-3  ">
                            <h2 class="">{{ $f->technology_name }}</h2>
                            <p style="width: 100%; height:35px; overflow:hidden">{{$f->technology_description}} </p>
                       
                            <a href="#"
                                class="rounded btn btn-blue p-2 text-decoration-none text-white tech-link"
                                data-id="{{ $f->id }}">Learn more</a>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</div>
@endsection