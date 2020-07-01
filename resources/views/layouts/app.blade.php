@extends('layouts.blank')

@section('layoutContent')
    <div id="app">
        @include('partials.navbar')
        <main class="pt-3">
            @yield('content')
        </main>
    </div>
@endsection
