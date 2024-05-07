@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="wrapper d-flex ">
        <div class="bg-blue-900">
            @include('layouts.sideNav')
        </div>
        <div class="d-flex justify-center w-[85vw] mt-2 mb-2">
            <x-app-layout>
                <x-slot name="header">
                    {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Profile') }}
                    </h2> --}}
                    {{-- <a href="{{ route('dashboard') }}" class="text-sm text-gray-800 underline hover:no-underline">
            {{ __('Back to Dashboard') }}
        </a> --}}

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-[50vw]">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>

                            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </x-slot>
            </x-app-layout>
        </div>
    </div>
    @include('layouts.footer')
@endsection
