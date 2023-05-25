@extends('layout')

@section('content')
    <div class="card mb-5">
        <div class="card-header pb-0">
            <h6> Depenses non approuvé</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive mt-4">
                <table id="table-datatable" class="table table-rounded table-striped-columns table-hover"
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
                        @foreach ($depensesInvalide as $depense)
                            <tr>
                                <td>{{ $depense->designation }}</td>
                                <td>{{ $depense->montant }} dh</td>
                                <td>
                                    @if ($depense->modepaiement == '1')
                                        Banque
                                    @else
                                        Caisse
                                    @endif
                                </td>
                                <td>{{ $depense->rubrique ? $depense->rubrique->libelle : '' }}</td>
                                <td>{{ $depense->user->name }}</td>
                                <td>
                                    {{-- <a href="{{ asset($depense->feuille) }}" class="btn btn-primary" target="_blank">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a> --}}
                                    <a href="{{ url('depense/pdf/' . $depense->feuille) }}" class="btn btn-primary"
                                        target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                        data-bs-target="#approveConfirmationModal{{ $depense->id }}">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="approveConfirmationModal{{ $depense->id }}" tabindex="-1"
                                        aria-labelledby="approveConfirmationModalLabel{{ $depense->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="approveConfirmationModalLabel{{ $depense->id }}">Confirmer la
                                                        suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir approve cet depense ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.depense.post', ['id' => $depense->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-success">Approve</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger bourdered mx-1 " data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmationModal{{ $depense->id }}">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="deleteConfirmationModal{{ $depense->id }}" tabindex="-1"
                                        aria-labelledby="deleteConfirmationModalLabel{{ $depense->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="deleteConfirmationModalLabel{{ $depense->id }}">Confirmer la
                                                        suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir supprimer cet depense ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.depense.cancel', ['id' => $depense->id]) }}"
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
