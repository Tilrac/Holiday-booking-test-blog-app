<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="w-full max-w-2xl">
                        <div class="card p-6 bg-gray-800 text-white rounded-md">
                            <div class="card-header text-white text-[20px]">Create New Post</div>

                            <div class="p-6">
                                <form method="POST" action="{{ route('user.posts.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="flex flex-col mb-4">
                                        <label for="title" class="form-label text-white">Title</label>
                                        <input type="text" class="form-control text-black @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-4">
                                        <label for="content" class="form-label text-white">Content</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror text-black" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-4">
                                        <label for="image" class="form-label text-white">Image (optional)</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror text-black" id="image" name="image">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text text-white">Max 1MB. Allowed types: JPG, PNG, JPEG, GIF.</div>
                                    </div>

                                    <button type="submit" class="bg-gray-950 p-4 text-white">Submit</button>
                                    <a href="{{ route('user.posts.index') }}" class="bg-gray-950 p-[18px] btn btn-secondary text-white">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>