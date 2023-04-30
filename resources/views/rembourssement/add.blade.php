@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un Remboursement</h5>
                        <form method="POST" class="needs-validation" novalidate="" action="{{ route('rembourssement.add') }}"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="designation" class="mb-2 text-muted">Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation"
                                    aria-describedby="emailHelp">
                                @error('designation')
                                    <div class="error"> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="credit_id" class="mb-2 text-muted">Crédit</label>
                                <select name="credit_id" class="form-select" aria-label="Default select example">
                                    <option selected>....</option>
                                    @foreach ($credits as $credit)
                                        @if ($credit->approuve == 1)
                                            <option value="{{ $credit->id }}"
                                                @if (old('credit_id') == $credit->id) selected @endif>
                                                {{ $credit->designation }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('credit_id')
                                    <div class="error"> {{ $message }}</div>
                                @enderror
                            </div>
                            @error('credit_id')
                                <div class="error"> {{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="montant" class="mb-2 text-muted">Montant</label>
                                <input type="number" name="montant" class="form-control" id="montant"
                                    aria-describedby="emailHelp">
                                @error('montant')
                                    <div class="error"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_remboursement" class="mb-2 text-muted">date remboursement</label>
                                <input type="date" name="date_remboursement" class="form-control" id="date_remboursement"
                                    aria-describedby="emailHelp">
                                @error('date_remboursement')
                                    <div class="error"> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="feuille" class="mb-2 text-muted">Feuille de Remboursement</label>
                                <input type="file" name="feuille" class="form-control" id="feuille"
                                    aria-describedby="emailHelp" accept="application/pdf">
                                @error('feuille')
                                    <div class="error"> {{ $message }}</div>
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
