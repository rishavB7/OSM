@extends('HOD_Admin.dashboard')

@section('schemeCreate')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schemes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Scheme Entry</h1>
        <form action="{{route('schemeCreate')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="scheme_name">Name of the scheme</label>
                <input type="text" name="scheme_name" id="scheme_name" class="form-control @error('scheme_name') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('scheme_name') }}">
                @error('scheme_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="scheme_description">Scheme Description</label>
                <input type="text" name="scheme_description" id="scheme_description" class="form-control @error('scheme_description') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('scheme_description') }}">
                @error('scheme_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="start_date">Starting Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                <label for="end_date">Ending Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
                {{-- Add error handling for other fields if needed --}}
                
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
            
            
    </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection



