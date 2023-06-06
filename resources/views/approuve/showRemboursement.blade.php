<?php
use App\Models\Adherent;
?>
@extends('layout')

@section('content')
    <div class="card mb-5">
        <div class="card-header pb-0">
            <h6> Crédits non approuvé</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive mt-4">

                <table id="table-datatable" class="table rounded  table-striped-columns table-hover  light-mode-table"
                    style="font-size: 0.9em;">
                    <thead>
                        <tr>
                            <th scope="col">Crédit</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Montant</th>
                            <th scope="col">date remboursement</th>
                            <th scope="col">Feuille</th>
                            <th scope="col">Signature</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($remboursementsInvalide as $remboursement)
                            <tr>
                                <td>{{ $remboursement->credit->designation }}</td>
                                <td>{{ $remboursement->designation }}</td>
                                <td>{{ $remboursement->montant }}</td>

                                <td>{{ $remboursement->date_remboursement }}</td>
                                <td>{{ $remboursement->user->name }}</td>
                                <td>
                                    <a href="{{ url('remboursement/pdf/' . $remboursement->feuille) }}"
                                        class="btn btn-primary" target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                        data-bs-target="#approveConfirmationModal{{ $remboursement->id }}">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="approveConfirmationModal{{ $remboursement->id }}"
                                        tabindex="-1"
                                        aria-labelledby="approveConfirmationModalLabel{{ $remboursement->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="approveConfirmationModalLabel{{ $remboursement->id }}">Confirmer
                                                        la suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir approve cet remboursement ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.remboursement.post', ['id' => $remboursement->id]) }}"
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
                                        data-bs-target="#deleteConfirmationModal{{ $remboursement->id }}">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="deleteConfirmationModal{{ $remboursement->id }}"
                                        tabindex="-1"
                                        aria-labelledby="deleteConfirmationModalLabel{{ $remboursement->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="deleteConfirmationModalLabel{{ $remboursement->id }}">Confirmer
                                                        la suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir supprimer cet remboursement ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.remboursement.cancel', ['id' => $remboursement->id]) }}"
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
