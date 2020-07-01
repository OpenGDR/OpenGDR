@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Mappa</a></li>
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.race.list') }}">Lista Razze</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if($isNew)
                        Nuova Razza
                        @else
                        Modifica {{ $race->name }}
                        @endif
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
            <form method="POST" action="{{ route('admin.race.edit', [ 'id' => $race->id] )}}" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h1 class="h3">
                        @if($isNew)
                        Nuova Razza
                        @else
                        Modifica {{ $race->name }}
                        @endif
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-3 mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input @error('active') is-invalid @enderror" id="active" name="active" value="true" {{ old('active')?'checked':($race->active?'checked':'') }}>
                                <label class="custom-control-label" for="active">Attiva</label>
                                @error('active')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input @error('avaible_registration') is-invalid @enderror" id="avaible_registration" name="avaible_registration" value="true" {{ old('avaible_registration')?'checked':($race->avaible_registration?'checked':'') }}>
                                <label class="custom-control-label" for="avaible_registration">Disponibile in registrazione</label>
                                @error('avaible_registration')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col col-md-6 mb-3">
                            <label for="name">Nome*</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required value="{{ old('name')?:$race->name }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-4 mb-3">
                            <label for="name_plural">Nome Plurale*</label>
                            <input type="text" class="form-control @error('name_plural') is-invalid @enderror" name="name_plural" id="name_plural" required value="{{ old('name_plural')?:$race->name_plural }}">
                            @error('name_plural')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col col-md-4 mb-3">
                            <label for="name_male">Nome Maschile (Singolare)*</label>
                            <input type="text" class="form-control @error('name_male') is-invalid @enderror" name="name_male" id="name_male" required value="{{ old('name_male')?:$race->name_male }}">
                            @error('name_male')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col col-md-4 mb-3">
                            <label for="name_female">Nome Femminile (Singolare)*</label>
                            <input type="text" class="form-control @error('name_female') is-invalid @enderror" name="name_female" id="name_female" required value="{{ old('name_female')?:$race->name_female }}">
                            @error('name_female')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-4 mb-3">
                            <label for="icon">Icona</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('icon') is-invalid @enderror" id="icon" name="icon" aria-describedby="iconHelpBlock">
                                <label class="custom-file-label" for="icon">Scegli il file</label>
                            </div>
                            <small id="iconHelpBlock" class="form-text text-muted">
                                Immagine (jpg o png) dimensione suggerita 50 x 50px
                            </small>
                            @error('icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md mb-3">
                            @if($race->icon)
                            <img src="{{ $race->icon_url }}" class="img-thumbnail img-fluid mx-auto d-block">
                            @endif
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label for="image">Immagine</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" aria-describedby="imageHelpBlock">
                                <label class="custom-file-label" for="image">Scegli il file</label>
                            </div>
                            <small id="imageHelpBlock" class="form-text text-muted">
                                Immagine (jpg o png) dimensione suggerita 1920 x 1920px
                            </small>
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md mb-3">
                            @if($race->image)
                                <img src="{{ $race->image_url }}" class="img-thumbnail img-fluid mx-auto d-block">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="url">Url sito web Razza</label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="url" value="{{ old('url')?:$race->url }}">
                            @error('url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label>Descrizione</label>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <editor input-name="description" initial-value="{{ old('description')?:$race->description }}"></editor>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Salva</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
