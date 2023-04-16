@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-dark">
                <div class="card-body">
                    <h5 class="card-title">Ajouter une recette</h5>
							<form method="POST" class="needs-validation" novalidate="" action="{{ route('recette.add') }}" enctype="multipart/form-data" autocomplete="off">
								@csrf
                                <div class="mb-3">
									<label class="mb-2 text-muted" for="designation">designation</label>
									<input id="designation" type="text" class="form-control" name="designation" value="{{ old('designation') }}" required autofocus>
                                    @error('designation')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
								</div>
								<div class="mb-3">
									<label class="mb-2 text-muted" for="montant">Montant</label>
									<input id="montant" type="text" class="form-control" name="montant" value="{{ old('montant') }}" required>
                                    @error('montant')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
								</div>
                                <div class="mb-3">
                                    <label for="av" class="form-label">Role</label>
                                    <select name="rubrique" class="form-control" id="#rubrique">
                                        @foreach ($rubriques as $rubrique)
                                        <option value="{{ $rubrique->id }}" >{{ $rubrique->libelle }}</option>
                                        @endforeach
                                    </select>
                                    @error('rubrique')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="av" class="form-label">Mode paiement</label>
                                    <select name="modepaiement" class="form-control" id="#mode">
                                        <option value="1" >Chéque</option>
                                        <option value="2" >En Espéce</option>
                                    </select>
                                    @error('modepaiement')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="feuille">Feuille de recette</label>
									<input id="feuille" type="file" class="form-control" name="feuille" value="{{ old('feuille') }}" >
                                    @error('feuille')
                                        <div class="error">{{ $message }}</div>
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
