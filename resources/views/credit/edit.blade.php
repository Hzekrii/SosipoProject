@extends('layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card  text-dark" style="background-color: ">
                    <div class="card-header">
                        <h4>Modifier un crédit</h4>
                    </div>
                    <div class="card-body">
       
        <form class="needs-validation" novalidate="" action="{{ route('post.credit.edit',['id' => $credit->id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" name="designation" value="{{ $credit->designation }}" class="form-control"
                    id="designation" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <select name="adherent_id" class="form-select" aria-label="Default select example">
                    <option selected>......</option>
                    @foreach ($adherents as $adherent)
                        <option value="{{ $adherent->id }}" @if ($credit->adherent_id == $adherent->id) selected @endif>
                            {{ $adherent->name }}
                        </option>
                    @endforeach
                </select>
                {{-- <label for="adherent_id" class="form-label">Adherent_id</label>
                <input type="number" name="adherent_id" value="{{ $credit->designation }}" class="form-control"
                    id="adherent_id" aria-describedby="emailHelp"> --}}
            </div>
            <div class="mb-3">
                <label for="montant" class="form-label">Montant</label>
                <input type="number" name="montant" class="form-control" value="{{ $credit->montant }}" id="montant"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="modepaiement" class="form-label">Mode paiement</label>
                <select name="modepaiement" class="form-select" aria-label="Default select example">
                    <option value="1" @if ($credit->modepaiement == 1) selected @endif>Banque</option>
                    <option value="2" @if ($credit->modepaiement == 2) selected @endif>Caisse</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_credit" class="form-label">date credit</label>
                <input type="date" name="date_credit" value="{{ $credit->date_credit }}" class="form-control"
                    id="date_credit" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" name="file" class="form-control" id="file" aria-describedby="emailHelp" accept="application/pdf">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>
</div>
</div>
</div>

@endsection
