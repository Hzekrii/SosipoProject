@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter une document</h5>
                        <form method="POST" class="needs-validation" novalidate="" action="{{ route('document.add') }}"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="designation">designation</label>
                                <input id="designation" type="text" class="form-control" name="designation"
                                    value="{{ old('designation') }}" required autofocus>
                                @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="av" class="form-label">Type document</label>
                                <select name="type" class="form-control" id="#type">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                                @error('rubrique')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="av" class="form-label">Nature</label>
                                <select name="nature" class="form-control" id="#mode">
                                    <option value="1">Financiers</option>
                                    <option value="2">Administratif</option>
                                    <option value="2">Légal</option>
                                    <option value="2">Technique</option>
                                    <option value="2">Commercial</option>
                                    <option value="2">Ressources humaines</option>
                                    <option value="2">Logistique</option>
                                    <option value="2">Autre</option>
                                </select>
                                @error('nature')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="feuille">Feuille de document</label>
                                <input id="feuille" type="file" class="form-control" name="feuille"
                                    value="{{ old('feuille') }}">
                                @error('feuille')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="align-items-center d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Envoye
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
