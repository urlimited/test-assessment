<table id="urls_list" class="table m-5">
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
            <td><a href="{{ $url->destination }}">{{ $url->destination }}</a></td>
            <td><a href="{{ $url->full_url }}">{{ $url->full_url }}</a></td>
            <td class="url-view">{{ $url->views }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
{{ $urls->links() }}


@section('urls.scripts_partial.table')
    <script type="text/javascript">
        $(document).ready(() => {
            $('#urls_list')
                .on(
                    'urlCreatedEvent',
                    (e, url) => {
                        const tBody = $(e.target).find('tbody');
                        const tBodyRows = tBody.find('tr');

                        const newUrlTr = `<tr>
                            <td>${url.id}</td>
                            <td><a href="${url.destination}">${url.destination}</a></td>
                            <td><a href="${url.shortened_url}">${url.shortened_url}</a></td>
                            <td>0</td>
                        </tr>`;

                        if (tBodyRows.length >= 10) {
                            tBodyRows.last().remove();
                        }

                        tBody.prepend(newUrlTr);

                        const totalNumberOfUrls = $('#total_number_urls');

                        totalNumberOfUrls.html(parseInt(totalNumberOfUrls.html()) + 1);
                    }
                );
        })
    </script>
@endsection
