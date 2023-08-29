<table class="table m-5">
    <thead>
    <tr>
        <th>ID</th>
        <th>Full URL</th>
        <th>Shortened URL</th>
        <th>Views</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($urls as $url)
        <tr>
            <td>{{ $url->id }}</td>
            <td><a target="_blank" href="{{ $url->destination }}">{{ $url->destination }}</a></td>
            <td><a target="_blank" href="{{ $url->full_url }}">{{ $url->full_url }}</a></td>
            <td>{{ $url->views }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
{{ $urls->links() }}
