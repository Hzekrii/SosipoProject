@extends('layout')

@section('content')

    <div class="card mb-5">
        <div class="card-header pb-0">
            <h6>Liste des recettes</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive my-4">
                <table id="recettes-table" class="table table-light table-striped-columns table-hover" style="font-size: 0.9em;">
                    @if (Auth::user()->role_id=="2")
                        <div class="d-flex justify-content-start ms-3 mt-3">
                            <a href="{{ route("recette.add") }}" class="btn btn-success text-light"><i class="bi bi-plus-circle me-2"></i>Nouveau recette</a>
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Montant</th>
                            <th>Mode de paiement</th>
                            <th>Rubrique</th>
                            <th>Approve</th>
                            <th>Rédigé par</th>
                            <th>Feuille</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recettes as $recette)
                            <tr>
                                <td>{{ $recette->designation }}</td>
                                <td>{{ $recette->montant }}</td>
                                <td>
                                    @if ($recette->modepaiement == "1")
                                        Chéque
                                    @else
                                        En Espéce
                                    @endif
                                </td>
                                <td>{{ $recette->rubrique ? $recette->rubrique->libelle : '' }}</td>
                                <td>
                                    @if ($recette->approuve)
                                        <span class="badge bg-success text-white mx-auto" style="width:90px:height:30px">Approuvé</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @endif
                                </td>
                                <td>{{ $recette->user->name }}</td>
                                <td>
                                    <a href="{{ url('recette/pdf/'.$recette->feuille) }}" class="btn btn-primary" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('recette.edit',['id' => $recette->id]) }}" class="btn btn-primary pe-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $recette->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <!-- Delete confirmation modal -->
                                        <div class="modal fade" id="deleteConfirmationModal{{ $recette->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $recette->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="deleteConfirmationModalLabel{{ $recette->id }}">Confirmer la suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        Vous ne pouvez pas supprimer cette recette.
                                                    </div>
                                                        <div class="modal-footer">
                                                            <div class="row justify-content-end">
                                                                <div class="col-auto">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                </div>
                                                                <div class="col-auto">
                                                                <form action="{{ route('recette.delete', $recette->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                </form>
                                                                </div>
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

