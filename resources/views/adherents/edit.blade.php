@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Modifier un adhérent</h5>
                        <form method="POST" class="needs-validation" novalidate=""
                            action="{{ route('adherents.update', $adherent->id) }}" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="matricule">Matricule</label>
                                <input id="matricule" type="text" class="form-control" name="matricule"
                                    value="{{ old('matricule', $adherent->matricule) }}" required autofocus>
                                @error('matricule')
                                    <div class="text-danger">>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="name">Nom</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name', $adherent->name) }}" required>
                                @error('name')
                                    <div class="text-danger">>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="prenom">Prénom</label>
                                <input id="prenom" type="text" class="form-control" name="prenom"
                                    value="{{ old('prenom', $adherent->prenom) }}" required>
                                @error('prenom')
                                    <div class="text-danger">>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="cin">CIN</label>
                                <input id="cin" type="text" class="form-control" name="cin"
                                    value="{{ old('cin', $adherent->cin) }}" required>
                                @error('cin')
                                    <div class="text-danger">>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categorie_id" class="form-label">Catégorie</label>
                                <select name="categorie_id" class="form-select" id="#categorie_id">
                                    <option value="">...</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}"
                                            {{ $adherent->categorie_id == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->libelle }}</option>
                                    @endforeach
                                </select>
                                @error('categorie_id')
                                    <div class="text-danger">>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="nb_enfant">Nombre d'enfants</label>
                                <input id="nb_enfant" type="number" min="0" class="form-control" name="nb_enfant"
                                    value="{{ old('nb_enfant', $adherent->nb_enfant) }}" required>
                                @error('nb_enfant')
                                    <div class="text-danger">>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="situation_maritale" class="form-label">Situation matrimoniale</label>
                                    <select class="form-select" id="situation_maritale" name="situation_maritale">
                                        <option value="">Sélectionnez une option</option>
                                        <option value="1" {{ $adherent->situation_maritale == 1 ? 'selected' : '' }}>
                                            Marié(e)</option>
                                        <option value="2" {{ $adherent->situation_maritale == 2 ? 'selected' : '' }}>
                                            Célibataire</option>
                                        <option value="3" {{ $adherent->situation_maritale == 3 ? 'selected' : '' }}>
                                            Divorcé(e)</option>
                                        <option value="4" {{ $adherent->situation_maritale == 4 ? 'selected' : '' }}>
                                            Veuf(ve)</option>
                                    </select>
                                </div>
                                @error('situation_maritale')
                                    <div class="text-danger">>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="align-items-center d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Modifier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
