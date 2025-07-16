<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="flex gap-[20px] flex-row bg-gray-800 p-4 rounded-md">
                            @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class=" w-[400px] h-[400px]" alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <h1 class="card-title">{{ $post->title }}</h1>
                                <p class="card-text">{{ $post->content }}</p>
                                <p class="text-muted">Posted by: {{ $post->user->name }}</p>
                                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>