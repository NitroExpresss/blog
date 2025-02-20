<!DOCTYPE html>
<html>
<head>
    <title>Список статей</title>
</head>
<body>
    <h1>Список статей</h1>
    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->description }}</p>
        <p><strong>Категория:</strong> {{ $post->category->name }}</p>
    @endforeach

    {{ $posts->links() }} <!-- Пагинация -->
</body>
</html>
