@extends('layouts.app')

@section('content')
    <div class="container">
        @include('url_shortening.form')

        @include('url_shortening.table')
    </div>
@endsection

@section('scripts')
    <script>
        const EVENTS = {
            URL_CREATED: "urlCreatedEvent",
            URL_CREATE_FAILED: "urlCreateFailedEvent",
        }

        // There is an imitation of a custom events register
        const observerSubscribers = {
            [EVENTS.URL_CREATED]: ['#urls_list', '#url_form'],
            [EVENTS.URL_CREATE_FAILED]: ['#url_form'],
        }

        window.customTriggerEvent = (event, details = null) => {
            if (observerSubscribers.hasOwnProperty(event)) {
                observerSubscribers[event]
                    .forEach((item) => $(item).trigger(event, details))
            }
        }
    </script>

    @yield('urls.scripts_partial.form')
    @yield('urls.scripts_partial.table')
@endsection
