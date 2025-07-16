<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8 text-center">
                <h1 class="display-4 mb-4 text-white">Welcome to Our Blog</h1>
                <p class="lead text-white">Read and share interesting articles with our community.</p>
                
                <div class="mt-5">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg mr-3 text-white">View All Posts</a>
                    
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg mr-3 text-white">Login</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg text-white">Register</a>
                    @endif
                    @endguest
                    
                    @auth
                    <a href="{{ route('user.posts.index') }}" class="btn btn-outline-primary btn-lg text-white">My Posts</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
