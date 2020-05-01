@extends('layouts.blank')

@section('layoutContent')
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
@endsection
