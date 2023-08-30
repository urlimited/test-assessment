<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Submit Long URL</div>
            <div class="card-body" id="url_form">
                <div class="form-group">
                    <label for="destination">Destination URL:</label>
                    <input type="url" name="destination" id="destination"
                           class="form-control"
                           required value="{{old('destination')}}">

                    <div id="destination-error" class="alert alert-danger mt-2 mb-0"></div>

                    <div id="destination-success" class="alert alert-success mt-2 mb-0"></div>

                    <button type="submit" id="shorten" class="btn btn-primary mt-4">Shorten</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('urls.scripts_partial.form')
    <script type="text/javascript">
        $(document).ready(() => {
            // Hide all alert windows
            $('#destination-error').hide();
            $('#destination-success').hide();

            // Add ajax request
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
                            success: (response) => {
                                window.customTriggerEvent('urlCreatedEvent', response);
                            },
                            error: (response) => {
                                window.customTriggerEvent('urlCreateFailedEvent', response.responseJSON.message);
                            }
                        }
                    );
                });

            // Register events on the page
            $('#url_form')
                .on(
                    'urlCreatedEvent',
                    (event, url) => {
                        $('#destination-error').hide();
                        $('#destination').removeClass('is-invalid');

                        $('#destination-success')
                            .show()
                            .html(`The url ${url.destination} with a shortened url of ${url.shortened_url} has been created`);
                    }
                )
                .on(
                    'urlCreateFailedEvent',
                    (event, message) => {
                        $('#destination-error')
                            .show()
                            .html(message);

                        $('#destination-success').hide();

                        $('#destination')
                            .removeClass('is-invalid')
                            .addClass('is-invalid');
                    }
                )

            ;
        })
    </script>
@endsection
