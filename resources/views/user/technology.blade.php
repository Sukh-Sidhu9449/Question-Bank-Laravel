



@extends('user_layout.template')
@section('main-content')

@foreach ($tech as $item)
    
<h1>welcome to technology page {{$item->technology_name}}</h1>

@endforeach

@endsection