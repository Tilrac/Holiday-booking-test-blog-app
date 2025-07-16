<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post By User') }}
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-[20px]">My Blog Posts</h1>
                    <a href="{{ route('user.posts.create') }}" class="bg-gray-950 rounded-md px-4 py-2">Create New Post</a>
                </div>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-gray-800 p-4 rounded-md flex items-center justify-center">
                    <table class="table-auto border-separate border-spacing-2 border border-gray-400 dark:border-gray-500">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 dark:border-gray-600">Title</th>
                                <th class="border border-gray-300 dark:border-gray-600">Status</th>
                                <th class="border border-gray-300 dark:border-gray-600">Created At</th>
                                <th class="border border-gray-300 dark:border-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-700">{{ $post->title }}</td>
                                <td class="border border-gray-300 dark:border-gray-700">
                                    <span class="badge 
                                        @if($post->status == 'published') bg-success 
                                        @elseif($post->status == 'rejected') bg-danger 
                                        @else bg-warning @endif">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td class="border border-gray-300 dark:border-gray-700">
                                <td class="border border-gray-300 dark:border-gray-700">{{ $post->created_at->format('M d, Y') }}</td>
                                <td class="border border-gray-300 dark:border-gray-700">
                                    <div class="flex gap-2">
                                        <a href="{{ route('user.posts.show', $post) }}" class="btn btn-sm btn-info">View</a>
                                        @if(in_array($post->status, ['pending', 'rejected']))
                                        <a href="{{ route('user.posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('user.posts.destroy', $post) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>