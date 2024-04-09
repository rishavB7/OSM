@extends('layouts.app')

@section('content')
@include('layouts.header')

<div class="px-4 py-2 leading-relaxed border rounded-lg sm:px-6 sm:py-4">
    <span class="font-semibold">{{ $message->user->name }}</span>
    <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
    <p class="text-sm">
        {{ $message->body }}
    </p>

    <x-app-layout>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Messages') }}
                </h2>
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-800 underline hover:no-underline">
                    {{ __('Back to Dashboard') }}
                </a>
            </div>
        </x-slot>
    
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if ($message = Session::get('success'))
                            <div class="w-full px-5 py-4 mb-5 bg-green-100 border-l-4 border-green-500">
                                {{ $message }}
                            </div>
                        @endif
    
                        <div class="grid grid-cols-12 gap-x-4">
                            
                            @if (Auth::user()->role == 2)
                                <div class="col-span-3">
                                    <a href="{{ route('messages.create') }}" class="block w-full p-2 text-center text-white bg-indigo-400 hover:bg-indigo-600">New Message</a>
                                </div>
                            @endif
                            <div class="col-span-9">
                                <table class="min-w-full leading-normal">
                                    <thead class="border-b bg-gray-50">
                                        <th class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">Sender</th>
                                        <th class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle">Subject</th>
                                        <th class="px-3 py-3 text-xs font-normal text-left text-gray-500 uppercase align-middle"></th>
                                    </thead>
                                    <tbody>
                                        @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
@include('layouts.footer')    
@endsection
