@extends('layouts.app')
@include('layouts.header')
@section('content')
    {{-- @include('layouts.navigation') --}}
    <div class="wrapper d-flex ">
        @include('layouts.sideNav')
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

            {{-- <a href="{{ route('dashboard') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right">Dashboard</button>
            </a>

            <a href="{{ route('listScheme') }}">
                <button class="btn btn-primary d-inline-block m-2 float-right ">Back</button>
            </a> --}}

            <h1 class="text-center text-3xl my-2">UPDATE SCHEME</h1>
            <form class="d-flex justify-center bg-white" action="{{ route('SchemeUpdate', $schemes->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group m-10">
                    <label class="mt-2 mb-1" for="scheme_name">Name of the scheme</label>
                    <input type="text" name="scheme_name" id="scheme_name"
                        class="lg:w-[720px] form-control @error('scheme_name') is-invalid @enderror" placeholder=""
                        aria-describedby="helpId" value="{{ $schemes->scheme_name }}">
                    @error('scheme_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label class="mt-2 mb-1" for="scheme_description">Scheme Description</label>
                    <input type="text" name="scheme_description" id="scheme_description"
                        class="lg:w-[720px] form-control @error('scheme_description') is-invalid @enderror" placeholder=""
                        aria-describedby="helpId" value="{{ $schemes->scheme_description }}">
                    @error('scheme_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <div class="d-flex">
                        <div class="mr-4">
                        <label class="mt-2 mb-1" for="start_date">Starting Date</label>
                        <input type="date" name="start_date" id="start_date"
                            class="form-control @error('start_date') is-invalid @enderror" placeholder=""
                            aria-describedby="helpId" value="{{ $schemes->start_date }}">
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div>
                        <label class="mt-2 mb-1" for="end_date">Ending Date</label>
                        <input type="date" name="end_date" id="end_date"
                            class="form-control @error('end_date') is-invalid @enderror" placeholder=""
                            aria-describedby="helpId" value="{{ $schemes->end_date }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    
                    <label class="mt-2 mb-1" for="physical_progress">Physical Progress</label>
                    <textarea type="text" name="physical_progress" id="physical_progress"
                        class="form-control lg:w-[720px] @error('physical_progress') is-invalid @enderror" placeholder="" value="{{old('physical_progress')}}"
                        aria-describedby="helpId" value=" {{ $schemes->physical_progress }}"></textarea>
                    @error('physical_progress')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label class="mt-2 mb-1" for="percentage_of_progress">% Of Progress</label>
                    <select name="percentage_of_progress" id="percentage_of_progress"
                        class="form-control lg:w-[720px] @error('percentage_of_progress') is-invalid @enderror" aria-describedby="helpId"
                        onchange="toggleCompletionYear(this)">
                        <option value="">Please select...</option>
                        @for ($i = 0; $i <= 100; $i += 10)
                            <option value="{{ $i }}" @if ($schemes->percentage_of_progress == $i) selected @endif>
                                {{ $i }}%</option>
                        @endfor
                    </select>
                    @error('percentage_of_progress')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mt-2">
                                <label for="funds_used" class="form-label">Fund Used</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" min="0" name="funds_used" id="funds_used"
                                        class=" form-control form-control-sm @error('funds_used') is-invalid @enderror"
                                        value="{{ old('funds_used') }}">
                                    @error('funds_used')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mt-2">
                                <label for="budget" class="form-label">Total Budget</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="budget" id="budget"
                                        class=" form-control form-control-sm @error('budget') is-invalid @enderror"
                                        value="{{  $schemes->budget  }}" disabled>
                                    @error('budget')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mt-2">
                                <label for="remaining_budget" class="form-label">Remaining Fund</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="remaining_budget" id="remaining_budget"
                                        class=" form-control form-control-sm @error('remaining_budget') is-invalid @enderror"
                                        value="{{  $schemes->remaining_budget  }}" disabled>
                                    @error('remaining_budget')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    


                    <label class="mt-2 mb-1" for="images">Upload Images (Maximum 4 Images)</label>
                    <div class="flex space-x-1 px-4">
                        <div class="file-upload-container">
                            <input type="file" name="images[]" id="images" multiple
                                class="form-control lg:w-[720px] @error('images') is-invalid @enderror" onchange="previewImages(event)"
                                style="width: 300px">
                            <div id="image-preview" class="image-preview"></div>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <label class="mt-2 mb-1" for="completionYear">Completion Year</label>
                    <input type="date" name="completion_year" id="completionYear" class="form-control lg:w-[720px]" disabled>

                    @error('completion_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label class="mt-2 mb-1" for="achievement">Achievement</label>
                    <input type="text" name="achievement" id="achievement" class="form-control lg:w-[720px]" disabled>
                    @error('achievement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary bg-blue-700">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var completionYearInput = document.getElementById('completionYear');
            var achievementInput = document.getElementById('achievement');

            // Initially disable completion year and achievement inputs
            completionYearInput.disabled = true;
            achievementInput.disabled = true;
        });

        function toggleCompletionYear(selectElement) {
            var completionYearInput = document.getElementById('completionYear');
            var achievementInput = document.getElementById('achievement');

            if (selectElement.value == '100') {
                completionYearInput.disabled = false;
                achievementInput.disabled = false;
            } else {
                completionYearInput.disabled = true;
                achievementInput.disabled = true;
                completionYearInput.value = ''; // Clear completion year if percentage of progress is not 100%
                achievementInput.value = ''; // Clear achievement if percentage of progress is not 100%
            }
        }

        // function previewImages(event) {
        //     var previewContainer = document.getElementById('image-preview');
        //     previewContainer.innerHTML = ''; 

        //     var files = event.target.files;

        //     for (var i = 0; i < files.length; i++) {
        //         var file = files[i];
        //         var reader = new FileReader();

        //         reader.onload = function(e) {
        //             var img = document.createElement('img');
        //             img.src = e.target.result;
        //             img.classList.add('img-thumbnail'); 
        //             img.classList.add('col-auto'); 
        //             previewContainer.appendChild(img);
        //         }

        //         reader.readAsDataURL(file);
        //     }
        // }

        function previewImages(event) {
            var previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';

            var files = event.target.files;
            var numImages = files.length;

            for (var i = 0; i < numImages; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    // img.classList.add('img-thumbnail'); 
                    // img.classList.add('col-auto'); 
                    previewContainer.appendChild(img);

                    // Add a line break after the second image
                    // if (previewContainer.children.length == 2) {
                    //     previewContainer.appendChild(document.createElement('br'));
                    // }
                }

                reader.readAsDataURL(file);
            }
        }
    </script>



    @include('layouts.footer')
@endsection
