@extends('layouts.app')
@include('layouts.header')
@section('content')

{{-- @include('layouts.navigation') --}}
 <div class="wrapper" >
    <div class="container">
        @if (session('alert-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('alert-success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('alert-failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('alert-failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{route('listScheme')}}">
            <button class="btn btn-primary d-inline-block m-2 float-right ">Back</button>
        </a>
            
        <h1 class="text-center text-4xl">Update</h1>
        <form action="{{ route('SchemeUpdate', $schemes->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="scheme_name">Name of the scheme</label>
                <input type="text" name="scheme_name" id="scheme_name" class="form-control @error('scheme_name') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $schemes->scheme_name }}">
                @error('scheme_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="scheme_description">Scheme Description</label>
                <input type="text" name="scheme_description" id="scheme_description" class="form-control @error('scheme_description') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $schemes->scheme_description }}">
                @error('scheme_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="start_date">Starting Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $schemes->start_date }}" >
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="end_date">Ending Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $schemes->end_date }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <label for="physical_progress">Physical Progress</label>
                <input type="text" name="physical_progress" id="physical_progress" class="form-control @error('physical_progress') is-invalid @enderror" placeholder="" aria-describedby="helpId" value=" {{$schemes->physical_progress}}">
                @error('physical_progress')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="percentage_of_progress">% Of Progress</label>
                <input type="number" min="0" max="100" name="percentage_of_progress" id="percentage_of_progress" class="form-control @error('percentage_of_progress') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{$schemes->percentage_of_progress}}">
                @error('percentage_of_progress')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="img1">Images</label>
                <div class="flex space-x-2 ">
                    <input type="file" name="img1" id="img1" class="form-control @error('img1') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $schemes->img1}}">
                    @error('img1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <input type="file" name="img2" id="img2" class="form-control @error('img2') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{$schemes->img2}}">
                    @error('img2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <input type="file" name="img3" id="img3" class="form-control @error('img3') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $schemes->img3 }}">
                    @error('img3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <input type="file" name="img4" id="img4" class="form-control @error('img4') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $schemes->img4 }}">
                    @error('img4')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Add error handling for other fields if needed --}}
            
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary bg-blue-700">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


@include('layouts.footer')
@endsection
    




