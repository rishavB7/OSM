@extends('layouts.app') 
@include('layouts.header')   
@include('layouts.menu')
@section('content')
 <div class="wrapper" >
     {{-- <h1>Main content</h1> --}}
     @include('layouts.carousel')
    </div>
@include('layouts.footer')
@endsection

