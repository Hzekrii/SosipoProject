@extends('layout')

@section('content')
    <div class="card mb-5">
        <div class="card-header pb-0">
            <h6>Recettes non approuvé</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive mt-4 w-100">

                <table id="table-datatable" class="table rounded  table-striped-columns table-hover  light-mode-table"
                    style="font-size: 0.9em;">
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Montant</th>
                            <th>Mode de paiement</th>
                            <th>Rubrique</th>
                            <th>Rédigé par</th>
                            <th>Feuille</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recettesInvalide as $recette)
                            <tr>
                                <td>{{ $recette->designation }}</td>
                                <td>{{ $recette->montant }} dh</td>
                                <td>
                                    @if ($recette->modepaiement == '1')
                                        Banque
                                    @else
                                        Caisse
                                    @endif
                                </td>
                                <td>{{ $recette->rubrique ? $recette->rubrique->libelle : '' }}</td>
                                <td>{{ $recette->user->name }}</td>
                                <td>
                                    <a href="{{ url('recette/pdf/' . $recette->feuille) }}" class="btn btn-primary"
                                        target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                </td>
                                <td>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="deleteConfirmationModal{{ $recette->id }}" tabindex="-1"
                                        aria-labelledby="deleteConfirmationModalLabel{{ $recette->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="deleteConfirmationModalLabel{{ $recette->id }}">Confirmer la
                                                        suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir approuvé cet recette ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.recette.cancel', ['id' => $recette->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger">Supprimer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('approuve.recette.post', ['id' => $recette->id]) }}"
                                        class="btn btn-primary pe-2">
                                        <i class="bi bi-check2-circle"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmationModal{{ $recette->id }}">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="deleteConfirmationModal{{ $recette->id }}" tabindex="-1"
                                        aria-labelledby="deleteConfirmationModalLabel{{ $recette->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="deleteConfirmationModalLabel{{ $recette->id }}">Confirmer la
                                                        suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir supprimer cet recette ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.recette.cancel', ['id' => $recette->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Supprimer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
