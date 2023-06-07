@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card  text-dark" style="background-color: ">
                    <div class="card-header">
                        <h4>Modifier une remboursement</h4>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation" novalidate=""
                            action="{{ route('post.remboursement.edit', ['id' => $remboursement->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" name="designation" value="{{ $remboursement->designation }}"
                                    class="form-control" id="designation" aria-describedby="emailHelp">
                                @error('designation')
                                    <div class="text-danger"> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select name="credit_id" class="form-select" aria-label="Default select example">
                                    @foreach ($credits as $credit)
                                        <option value="{{ $credit->id }}"
                                            @if ($remboursement->credit_id == $credit->id) selected @endif>
                                            {{ $credit->designation }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('credit_id')
                                    <div class="text-danger"> {{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="number" name="montant" class="form-control"
                                    value="{{ $remboursement->montant }}" id="montant" aria-describedby="emailHelp">
                                @error('montant')
                                    <div class="text-danger"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_remboursement" class="form-label">date remboursement</label>
                                <input type="date" name="date_remboursement"
                                    value="{{ $remboursement->date_remboursement }}" class="form-control"
                                    id="date_remboursement" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="feuille" class="form-label">Feuille de Remboursement</label>
                                <input type="file" name="feuille" class="form-control" id="feuille"
                                    aria-describedby="emailHelp">
                                @error('feuille')
                                    <div class="text-danger"> {{ $message }}</div>
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
