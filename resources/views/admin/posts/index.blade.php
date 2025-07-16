<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Posts') }}
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <h1 class="my-4 text-[20px]">Manage Blog Posts</h1>

                <div class="flex justify-center items-center mb-4">
                    <table class="table-auto border-separate border-spacing-2 border border-gray-400 dark:border-gray-500" id="posts-table">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 dark:border-gray-600">Title</th>
                                <th class="border border-gray-300 dark:border-gray-600">Author</th>
                                <th class="border border-gray-300 dark:border-gray-600">Status</th>
                                <th class="border border-gray-300 dark:border-gray-600">Created At</th>
                                <th class="border border-gray-300 dark:border-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-700">{{ $post->title }}</td>
                                <td class="border border-gray-300 dark:border-gray-700">{{ $post->user->name }}</td>
                                <td class="border border-gray-300 dark:border-gray-700">
                                    <select class="form-select status-select text-black" data-post-id="{{ $post->id }}">
                                        <option value="pending" {{ $post->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="rejected" {{ $post->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </td class="border border-gray-300 dark:border-gray-700">
                                <td class="border border-gray-300 dark:border-gray-700">{{ $post->created_at->format('M d, Y') }}</td>
                                <td class="border border-gray-300 dark:border-gray-700">
                                    <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-info">View</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('.status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const postId = this.dataset.postId;
            const newStatus = this.value;
            
            fetch(`/admin/posts/${postId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optionally show a success message
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>