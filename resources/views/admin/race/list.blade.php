@extends('layouts.app')
@push('scripts')
{{$dataTable->scripts()}}
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Mappa</a></li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active" aria-current="page">Lista Razze</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h1 class="h3">Razze</h1>
                    @can('create', \App\Models\Race::class)
                    <div>
                    <a href="{{ route('admin.race.edit') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i> Nuova Razza
                    </a>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    {!! $dataTable->table(['class' => 'table'], true) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


