<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    @foreach ( $fruits as $fruit )
        <a href="/search/{{ $fruit->id }}">{{ $fruit->name}}</a>
    @endforeach
</div>
