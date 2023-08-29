@extends('layouts.app')

@section('content')
    <div class="container">
        @include('url_shortening.form')

        @include('url_shortening.table')
    </div>
@endsection
