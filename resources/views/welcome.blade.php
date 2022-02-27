<x-layouts.guest>
    <main class="flex-shrink-0">
        <div class="container homepage">
            <h1 class="mt-5">🐽 {{ config('app.name') }}</h1>
            <p class="lead">Social Cognition Lab - Queen's University</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Sign in</a>
        </div>
    </main>
        
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container homepage">
            <span class="text-muted">&copy; {{ config('app.name') }} {{ date_format(new DateTime(), 'Y') }} - Social Cognition Lab - Queen's University.</span>
        </div>
    </footer>
</x-layouts.guest>
