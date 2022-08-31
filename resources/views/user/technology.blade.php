@section('main-content')


<div class="container div2" >
    <div class="row">
        @foreach ($frame1 as $f)
        <div class="col-md-6  div1">
            <h2 style=" margin-left:2px;">
                <a href="#" style="text-decoration:none; color:black"data-id="{{ $f->id }}">
                    {{ $f->framework_name }}
                </a>
            </h2>
            <a href="#" class="btn btn-default mt-5  link" data-id="{{ $f->id }}"style="border:1px solid green;">Learn More..</a>
        </div>
        @endforeach
        
    </div>
</div>
<div class="tech_display" id="tech_question_display">


    
</div>


@endsection
@extends('user_layout.template')
        