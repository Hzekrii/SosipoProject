@extends('layout')

@section('content')

    <div class="card mb-5">
        <div class="card-header pb-0">
            <h6>Liste des adhrents</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive my-4">
                <table id="recettes-table" class="table table-light table-striped-columns table-hover" style="font-size: 0.9em;">
                    @if (Auth::user()->role_id !="3")
                        <div class="d-flex justify-content-start ms-3 mt-3">
                            <a href="{{ route("adherents.create") }}" class="btn btn-success text-light"><i class="bi bi-plus-circle me-2"></i>Nouveau Adherents</a>
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>CIN</th>
                            <th>Categorie</th>
                            <th>Nombre des enfents</th>
                            <th>Situation matrimoniale</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adherents as $adherent)
                            <tr>
                                <td>{{ $adhrent->matricule }}</td>
                                <td>{{ $adhrent->name }}</td>
                                <td>{{ $adhrent->prenom }}</td>
                                <td>{{ $adhrent->cin }}</td>
                                <td>
                                    @foreach ($categories as $categorie)
                                        @if ($categorie->id == $adherent->categorie_id)
                                            {{ $categorie->libelle }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $adhrent->nb_enefent }}</td>
                                <td>
                                    @switch($adhrent->situation_maritale)
                                        @case(1)
                                            Marié(e)
                                            @break
                                        @case(2)
                                            Célibataire
                                            @break
                                        @case(3)
                                            Divorcé(e)
                                            @break
                                        @case(4)
                                            Veuf(ve)
                                            @break
                                        @default
                                    @endswitch
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('adhrents.edit',["adhrent" => $adherent]) }}" class="btn btn-primary pe-2">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $recette->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <!-- Delete confirmation modal -->
                                        <div class="modal fade" id="deleteConfirmationModal{{ $adhrent->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $adherent->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="deleteConfirmationModalLabel{{ $recette->id }}">Confirmer la suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        Vous ne pouvez pas supprimer ce adherent.
                                                    </div>
                                                        <div class="modal-footer">
                                                            <div class="row justify-content-end">
                                                                <div class="col-auto">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                </div>
                                                                <div class="col-auto">
                                                                <form action="{{ route('adhrents.destroy', $adherent->id) }}" method="POST">
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

