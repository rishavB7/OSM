@extends('layouts.app')

@section('title', 'Upload Document')
@section('content')
    @include('layouts.header')

    <div class="wrapper d-flex">
        @include('layouts.sideNav')
        <div class="container mt-0 mx-4 mb-4">
            <h4 class="text-center text-2xl mt-2">Upload Document</h4>

            @if (session('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert-success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('alert-failed'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert-failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right py-1">Back</button>
            </a>
            <div class=" w-100 d-flex justify-content-center  align-items-center">

                <form method="POST" action="{{ route('uploadReportDocs') }}" class="w-[30%]" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div class="form-group w-[24rem]">
                        <label for="name">Subject</label>
                        <input id="title" class="form-control rounded-md" type="text" name="title"
                            value="{{ old('title') }}" required autofocus />
                        @error('title')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File -->
                    <div class="form-group w-[24rem]">
                        <label for="designation">File</label>
                        <input id="file" class="form-control rounded-md" type="file" name="file"
                            value="{{ old('file') }}" required autocomplete="username" accept=".pdf, .docx" />
                        @error('file')
                            <p class="mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group w-[24rem]">
                        <button type="submit" class="btn btn-primary bg-blue-700 w-[150px]">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footer')

@endsection
