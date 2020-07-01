@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Mappa</a></li>
                    <li class="breadcrumb-item">Utente</li>
                    <li class="breadcrumb-item active" aria-current="page">Impostazioni Utente</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('user.settings.update') }}">
                @csrf
                <div class="card mb-3">
                    <div class="card-header">
                        Informazioni utente
                    </div>
                    <div class="card-body">
                        @if (session('updateinfo'))
                        <div class="alert alert-success" role="alert">
                            Le tue informazioni sono state aggiornate con successo!
                        </div>
                        @endif<div class="row">
                            <div class="col col-md-6 form-group">
                                <label for="email">Email *</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required value="{{ old('email')?:$user->email }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6 form-group">
                                <label for="name">Nome Utente</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')?:$user->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col col-md-6 form-group">
                                <label for="surname">Cognome Utente</label>
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname')?:$user->surname }}">
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6 form-group">
                                <label for="date_of_birth">Data di nascita</label>
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth')?:(!is_null($user->date_of_birth)?$user->date_of_birth->format('Y-m-d'):'') }}">
                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col col-md-6 form-group">
                                <label for="motto">Motto</label>
                                <input id="motto" type="text" class="form-control @error('motto') is-invalid @enderror" name="motto" value="{{ old('motto')?:$user->motto }}">
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Descrizione</label>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <editor input-name="description" initial-value="{{ old('description')?:$user->description }}"></editor>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Aggiorna Informazioni</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col col-md-6">
            <div class="card h-100">
                <form method="POST" action="{{ route('user.settings.password') }}">
                    @csrf
                    <div class="card-header">Aggiorna password</div>
                    <div class="card-body">

                        @if (session('updatepassword'))
                        <div class="alert alert-success" role="alert">
                            La tua password è stata aggiornata con successo!
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="current-password" class="col-md-4 col-form-label text-md-right">{{ __('Password Corrente') }}</label>
                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" required>
                                @error('current-password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Salva</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    Cancella Utente
                </div>
                <div class="card-body">
                    Cancellando l'utente si elimineranno tutti i dati presenti nel gioco, è un'azione irreversibile.
                </div>
                <div class="card-footer text-right">
                    <span class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteUser">
                        <i class="far fa-trash-alt"></i> Elimina Utente
                    </span>
                </div>
                <div class="modal fade" id="confirmDeleteUser" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteUserLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('user.settings.delete-user') }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteUserLabel">Cancella utente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler procedere alla cancellazione definitiva del tuo utente?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">No!</button>
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Si, voglio eliminare il mio utente</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
