@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card text-dark">
                <div class="card-body">
                    <h5 class="card-title">Ajouter un Crédit</h5>
                        <form method="POST" class="needs-validation" novalidate="" action="{{ route('credit.add') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                            <label for="designation" class="mb-2 text-muted">Designation</label>
                            <input type="text" name="designation" class="form-control" id="designation" aria-describedby="emailHelp">
                            @error('designation')
                                <div class="error"> {{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-3">
                            <label for="adherent" class="mb-2 text-muted">Adherent</label>
                            <select name="adherent_id" class="form-select" aria-label="Default select example" id="adherent">
                                <option selected>....</option>
                                @foreach ($adherents as $adherent)
                                    <option value="{{ $adherent->id }}" @if (old('adherent_id') == $adherent->id) selected @endif>
                                        {{ $adherent->name }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            @error('adherent_id')
                            <div class="error"> {{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                            <label for="montant" class="mb-2 text-muted">Montant</label>
                            <input type="number" name="montant" class="form-control" id="montant" aria-describedby="emailHelp">
                            @error('montant')
                                <div class="error"> {{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-3">
                            <label for="modepaiement" class="mb-2 text-muted">Mode paiement</label>
                            <select name="modepaiement" class="form-select" aria-label="Default select example">
                                <option selected>......</option>
                                <option value="1">Banque</option>
                                <option value="2">Caisse</option>
                            </select>
                            @error('modepaiement')
                                <div class="error"> {{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-3">
                            <label for="date_credit" class="mb-2 text-muted">date credit</label>
                            <input type="date" name="date_credit" class="form-control" id="date_credit" aria-describedby="emailHelp">
                            @error('date_credit')
                                <div class="error"> {{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-3">
                            <label for="file" class="mb-2 text-muted">Fichier</label>
                            <input type="file" name="file" class="form-control" id="file" aria-describedby="emailHelp"
                                accept="application/pdf">
                            @error('file')
                                <div class="error is-invalid"> {{ $message }}</div>
                            @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection