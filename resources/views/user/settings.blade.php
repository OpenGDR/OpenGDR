@extends('layouts.app')

@section('content')
    <div class="container mt-3">
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
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
        </div>
    </div>
@endsection
