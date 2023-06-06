@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card  text-dark" style="background-color: ">
                    <div class="card-header">
                        <h4>Ajouter une depense</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate=""
                            action="{{ route('post.depense.edit', ['id' => $depense->id]) }}" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="designation">Designation</label>
                                <input id="designation" type="text" class="form-control " name="designation"
                                    value="{{ old('designation', $depense->designation) }}" required autofocus>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="montant">Montant</label>
                                <input id="montant" type="text" class="form-control "
                                    @if ($depense->approuve == true) readonly @endif name="montant"
                                    value="{{ $depense->montant }}">
                                @error('montant')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="rubrique" class="form-label">Rubrique</label>
                                <select name="rubrique" class="form-select" id="rubrique">
                                    @foreach ($rubriques as $rubrique)
                                        <option value="{{ $rubrique->id }}"
                                            @if ($depense->rubrique_id == $rubrique->id) selected @endif>{{ $rubrique->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rubrique')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if ($depense->approuve == false)
                                <div class="mb-3">
                                    <label for="modepaiement" class="form-label">Mode paiement</label>
                                    <select name="modepaiement" class="form-select" id="modepaiement">
                                        <option value="1" @if ($depense->modepaiement == 1) selected @endif>Chéque
                                        </option>
                                        <option value="2" @if ($depense->modepaiement == 2) selected @endif>En Espéce
                                        </option>
                                    </select>
                                    @error('modepaiement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label" for="feuille">Feuille de depense</label>
                                <div>
                                    <a href="{{ url('depense/pdf/' . $depense->feuille) }}" class="btn btn-primary mb-3"
                                        target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                </div>
                                <input id="feuille" type="file" class="form-control" name="feuille"
                                    value="{{ old('feuille') }}">
                                @error('feuille')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="align-items-center d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Edit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
