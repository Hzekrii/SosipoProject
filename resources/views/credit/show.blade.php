@extends('layout')

@section('content')
    <div class="card my-5">
        <div class="card-header pb-0">
            <h6>Liste des Crédits</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive my-4">
                <table id="table-datatable" class="table rounded  table-striped-columns table-hover  light-mode-table"
                    style="font-size: 0.9em;">
                    @if (Auth::user()->role_id == '2')
                        <div class="d-flex justify-content-start ms-3 mt-3">
                            <a href="{{ route('credit.add') }}" class="btn btn-success text-light"><i
                                    class="bi bi-plus-circle me-2"></i>Nouveau credit</a>
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th scope="col">Adherent</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Mode Paiement</th>
                            <th scope="col">date credit</th>
                            <th scope="col">Statut</th>
                            <th scope="col">reste</th>
                            <th scope="col">Signature</th>
                            <th scope="col">Feuille</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($credits as $credit)
                            <tr>
                                <td> {{ $credit->adherent->matricule }} - {{ $credit->adherent->name }} {{ $credit->adherent->prenom }}</td>
                                <td>{{ $credit->designation }}</td>
                                <td>{{ $credit->montant }}</td>
                                <td>
                                    @if ($credit->modepaiement == '1')
                                        Chéque
                                    @else
                                        En Espéces
                                    @endif
                                </td>
                                <td>
                                    {{ $credit->date_credit }}
                                </td>
                                <td>
                                    @if ($credit->approuve)
                                        <span class="badge bg-success text-white mx-auto"
                                            style="width:90px:height:30px">Approuvé</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($credit->approuve)
                                        @foreach ($restes as $reste)
                                            @if ($reste['credit'] == $credit->id)
                                                {{ $reste['reste'] > 0 ? $reste['reste'] : 0 }}
                                            @endif
                                        @endforeach
                                    @else
                                        En attente
                                    @endif
                                </td>

                                <td>
                                    {{ $credit->user->name }}
                                </td>
                                {{-- <td>{{ $credit->user->name }}</td> --}}
                                <td>
                                    <a href="{{ url('credit/pdf/' . $credit->file) }}" class="btn btn-primary"><i
                                            class="bi bi-file-earmark-pdf"></i></a>
                                </td>
                                <td>
                                    @if ($credit->approuve)
                                        {{ 'ACTIONS INTERDITS !' }}
                                    @else
                                        <a href="{{ route('credit.edit', ['id' => $credit->id]) }}"
                                            class="btn btn-primary mx-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmationModal{{ $credit->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <!-- Delete confirmation modal -->
                                        <div class="modal fade" id="deleteConfirmationModal{{ $credit->id }}"
                                            tabindex="-1"
                                            aria-labelledby="deleteConfirmationModalLabel{{ $credit->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark"
                                                            id="deleteConfirmationModalLabel{{ $credit->id }}">Confirmer
                                                            la suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                        Vous ne pouvez pas supprimer cette credit.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row justify-content-end">
                                                            <div class="col-auto">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Annuler</button>
                                                            </div>
                                                            <div class="col-auto">
                                                                <form action="{{ route('credit.delete', $credit->id) }}"
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
