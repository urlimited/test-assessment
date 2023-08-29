<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Submit Long URL</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="destination">Destination URL:</label>
                    <input type="url" name="destination" id="destination"
                           class="form-control"
                           required value="{{old('destination')}}">

                    <div id="destination-error" class="alert alert-danger mt-2 mb-0"></div>

                    <button type="submit" id="shorten" class="btn btn-primary mt-4">Shorten</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        $(document).ready((e) => {
            $('#destination-error').hide();

            $('#shorten')
                .click((e) => {
                    e.preventDefault();

                    const destination = document.getElementById('destination').value;

                    const content = JSON.stringify(
                        {
                            destination,
                        }
                    )

                    $.ajax(
                        {
                            url: "{{ route('urls.store') }}",
                            type: "post",
                            data: content,
                            contentType: "application/json",
                            success: () => {
                                $('#destination-error').hide();
                                $('#destination').removeClass('is-invalid');
                            },
                            error: (response) => {
                                $('#destination-error')
                                    .show()
                                    .html(response.responseJSON.message);

                                $('#destination')
                                    .removeClass('is-invalid')
                                    .addClass('is-invalid');
                            }
                        }
                    );
                });
        })
    </script>
@endsection
