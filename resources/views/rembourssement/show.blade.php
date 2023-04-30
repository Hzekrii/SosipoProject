@extends('layout')

@section('content')
    <div class="card my-5">
        <div class="card-header pb-0">
            <h6>Liste des Remboursements</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive my-4">
                <table id="recettes-table" class="table rounded table-light table-striped-columns table-hover"
                    style="font-size: 0.9em;">
                    @if (Auth::user()->role_id == '2')
                        <div class="d-flex justify-content-start ms-3 mt-3">
                            <a href="{{ route('rembourssement.add') }}" class="btn btn-success text-light"><i
                                    class="bi bi-plus-circle me-2"></i>Nouveau rembourssement</a>
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th scope="col">Crédit</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Approuve</th>
                            <th scope="col">date remboursement</th>
                            <th scope="col">Feuille</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rembourssements as $rembourssement)
                            <tr>
                                <td>{{ $rembourssement->credit->designation }}</td>
                                <td>{{ $rembourssement->designation }}</td>
                                <td>{{ $rembourssement->montant }}</td>
                                <td>
                                    @if ($rembourssement->approuve)
                                        <span class="badge bg-success text-white mx-auto"
                                            style="width:90px:height:30px">Approuvé</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @endif
                                </td>
                                <td>{{ $rembourssement->date_remboursement }}</td>
                                {{-- <td>{{ $rembourssement->user->name }}</td> --}}
                                <td>
                                    <a href="{{ url('rembourssement/pdf/' . $rembourssement->feuille) }}"
                                        class="btn btn-primary" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                </td>
                                <td>
                                    @if ($rembourssement->approuve)
                                        {{ 'ACTIONS INTERDITS !' }}
                                    @else
                                        <a href="{{ route('rembourssement.edit', ['id' => $rembourssement->id]) }}"
                                            class="btn btn-primary mx-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmationModal{{ $rembourssement->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <!-- Delete confirmation modal -->
                                        <div class="modal fade" id="deleteConfirmationModal{{ $rembourssement->id }}"
                                            tabindex="-1"
                                            aria-labelledby="deleteConfirmationModalLabel{{ $rembourssement->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark"
                                                            id="deleteConfirmationModalLabel{{ $rembourssement->id }}">
                                                            Confirmer la suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        Vous ne pouvez pas supprimer cette rembourssement.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row justify-content-end">
                                                            <div class="col-auto">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Annuler</button>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form
                                                                    action="{{ route('rembourssement.delete', $rembourssement->id) }}"
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
