@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Mappa</a></li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.list') }}">Utenti</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Modifica [ {{ $user->id }} ] {{ $user->email }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
    <div class="row">
        <div class="col">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col mb-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3">
                        Modifica [ {{ $user->id }} ] {{ $user->email }}
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" value="{{ $user->email }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-6 form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="col col-md-6 form-group">
                            <label for="surname">Cognome</label>
                            <input type="text" class="form-control" id="surname" value="{{ $user->surname }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-6 form-group">
                            <label for="date_of_birth">Data di nascita</label>
                            <input type="text" class="form-control" id="date_of_birth" value="{{ $user->date_of_birth?$user->date_of_birth->format('d/m/Y'):'' }}" disabled>
                        </div>
                        <div class="col col-md-6 form-group">
                            <label for="motto">Motto</label>
                            <input type="text" class="form-control" id="motto" value="{{ $user->motto }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="">Descrizione</p>
                            <div class="bg-light rounded p-3">
                            {!! $user->description !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-auto ml-auto">
                            <form method="POST" action="{{ route('admin.user.edit', [ 'id' => $user->id] )}}">
                                @csrf
                                @if($user->banned)
                                    <input type="hidden" name="action" value="unban">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-user"></i> Rimuovi ban utente</button>
                                @else
                                    <input type="hidden" name="action" value="ban">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-user-slash"></i> Banna utente</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
