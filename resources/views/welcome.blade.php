@extends('layouts.app') 
@include('layouts.header')   

@section('content')
 <div class="wrapper" >
     {{-- <h1>Main content</h1> --}}
     @include('layouts.carousel')
    </div>
@include('layouts.footer')
@endsection

