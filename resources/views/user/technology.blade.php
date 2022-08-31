@extends('user_layout.template')
@section('main-content')
    {{-- @foreach ($tech as $item)
 <div style="width:100%; background-color:aliceblue:50px;" class="shadow">   
<h1 class="mt-2" style="margin-left:40px; font-size:30px;">{{$item->technology_name}}</h1>

 </div>
@endforeach --}}

    <div clas="container" style="height:500px;">
        <div class="div1 "style="height:80px; display:flex; margin-left:30px;background-color:white;">
            @foreach ($frame1 as $f)
         
                <h2 style=" margin-left:30px;"><a href="#" data-id="{{$f->id}}">
                    {{ $f->framework_name }}</h2>
            @endforeach
        </div>
     
        {{-- <div class="div1 "style="height:80px; display:flex; margin-left:30px;background-color:white;">
            {{-- @foreach ($frame as $f) --}}
            {{-- <input type="text" value="{{$frame->id}}">
                <h2 style=" margin-left:30px;"><a href="#" data-id="{{$frame->id}}">
                    {{ $frame->framework_name }}</h2> --}}
            {{-- @endforeach --}}
        {{-- </div>  --}}
        <div class="div1 "style="height:80px; display:flex; margin-left:30px;background-color:white;">
            @foreach ($question as $q)
          
                <h2 style=" margin-left:30px;"><a href="#" data-id="{{$q->id}}">
                    {{ $q->question }}</h2>
            @endforeach
        </div>
     
 
    </div>
@endsection
