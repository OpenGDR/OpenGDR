@extends('layouts.blank')

@section('layoutContent')
    <div id="app">
        @include('partials.navbar')
        <main>
            @yield('content')
        </main>
    </div>
@endsection
