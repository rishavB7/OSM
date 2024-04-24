@extends('layouts.app')

@section('content')
@include('layouts.header')
    
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create new message') }}
            </h2>

            <a href="{{ route('dashboard') }}" class="text-sm text-gray-800 underline hover:no-underline">
                {{ __('Back to Dashboard') }}
            </a>
        </div>
    
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('messages.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <!-- Subject Form Input -->
                            <div>
                                <x-label for="subject" :value="__('Subject')" />
                                <x-input id="subject" class="block w-full mt-1" type="text" name="subject"
                                    :value="old('subject')" />
                            </div>
                            
                            <!-- Recipients list -->
                            @if (app('request')->query('schemeId') === null)
                            <div class="mt-4">
                                <x-label for="recipient" :value="__('Recipient')" />
                                <select name="recipient"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <x-label for="recipient" :value="__('Recipient')" />
                                <select name="recipient"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value={{$createdByUserMail -> id}}>{{$email_created_by}}</option>
                                </select>
                            @endif
                            <!-- Message Form Input -->
                            <div class="mt-4">
                                <x-label for="message" :value="__('Message')" />
                                <textarea name="message" rows="10"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('message') }}</textarea>
                            </div>

                            <!-- Submit Form Input -->
                            <div class="mt-4">
                                <x-button>Submit</x-button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-slot>
</x-app-layout>


@include('layouts.footer')    
@endsection