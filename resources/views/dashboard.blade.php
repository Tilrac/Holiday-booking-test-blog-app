<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(auth()->user()->isAdmin())
                        <p>Welcome, Admin!</p>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Manage Posts</a>
                    @else
                        <p>Welcome, {{ auth()->user()->name }}!</p>
                        <a href="{{ route('user.posts.per.user') }}" class="btn btn-primary">My Posts</a> |
                        <a href="{{ route('user.posts.create') }}" class="btn btn-success">Create New Post</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>