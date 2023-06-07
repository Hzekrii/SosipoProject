@extends('layout')

@section('content')
    <div class="card my-5">
        <div class="card-header pb-0">
            <h6>Liste des Depenses</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive my-4">
                <table id="table-datatable" class="table rounded  table-striped-columns table-hover  light-mode-table"
                    style="font-size: 0.9em;">
                    @if (Auth::user()->role_id == '2')
                        <div class="d-flex justify-content-start ms-3 mt-3">
                            <a href="{{ route('depense.add') }}" class="btn btn-success text-light"><i
                                    class="bi bi-plus-circle me-2"></i>Nouveau depense</a>
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Montant</th>
                            <th>Mode de paiement</th>
                            <th>Rubrique</th>
                            <th>Statut</th>
                            <th>Rédigé par</th>
                            <th>Feuille</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($depenses as $depense)
                            <tr>
                                <td>{{ $depense->designation }}</td>
                                <td>{{ $depense->montant }}</td>
                                <td>
                                    @if ($depense->modepaiement == '1')
                                        Chéque
                                    @else
                                        En Espéce
                                    @endif
                                </td>
                                <td>{{ $depense->rubrique ? $depense->rubrique->libelle : '' }}</td>
                                <td>
                                    @if ($depense->approuve)
                                        <span class="badge bg-success text-white mx-auto"
                                            style="width:90px:height:30px">Approuvé</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @endif
                                </td>
                                <td>{{ $depense->user->name }}</td>
                                <td>
                                    <a href="{{ url('depense/pdf/' . $depense->feuille) }}" class="btn btn-primary"
                                        ><i class="bi bi-file-earmark-pdf"></i></a>
                                </td>
                                <td>
                                    <a href="{{ route('depense.edit', ['id' => $depense->id]) }}"
                                        class="btn btn-primary mx-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if ($depense->approuve == false)

                                        <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmationModal{{ $depense->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <!-- Delete confirmation modal -->
                                        <div class="modal fade" id="deleteConfirmationModal{{ $depense->id }}"
                                            tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $depense->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark"
                                                            id="deleteConfirmationModalLabel{{ $depense->id }}">Confirmer
                                                            la
                                                            suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Vous ne pouvez pas supprimer cette depense.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row justify-content-end">
                                                            <div class="col-auto">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Annuler</button>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form action="{{ route('depense.delete', $depense->id) }}"
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
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
