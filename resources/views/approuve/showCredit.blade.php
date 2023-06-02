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
<<<<<<< HEAD
=======
              
>>>>>>> 58b6fc75cc4d82889d7cd0582f995d8805c6f40a
                <table id="table-datatable" class="table table-striped dt-responsive nowrap light-mode-table"
                    style="font-size: 0.9em;">
                    <thead>
                        <tr>
                            <th scope="col">Adherent</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Mode Paiement</th>
                            <th scope="col">date credit</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($creditsInvalide as $credit)
                            <tr>
                                <td>{{ $credit->adherent->name }}</td>
                                <td>{{ $credit->designation }}</td>
                                <td>{{ $credit->montant }}</td>
                                <td>
                                    @if ($credit->modepaiement == 1)
                                        Caisse
                                    @else
                                        Banque
                                    @endif
                                </td>
                                <td>{{ $credit->date_credit }}</td>

                                <td>
                                    <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                        data-bs-target="#approveConfirmationModal{{ $credit->id }}">
                                        <i class="bi bi-check2-circle"></i>
                                    </button>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="approveConfirmationModal{{ $credit->id }}" tabindex="-1"
                                        aria-labelledby="approveConfirmationModalLabel{{ $credit->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="approveConfirmationModalLabel{{ $credit->id }}">Confirmer la
                                                        suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir approve cet credit ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.credit.post', ['id' => $credit->id]) }}"
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
                                        data-bs-target="#deleteConfirmationModal{{ $credit->id }}">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                    <!-- Delete confirmation modal -->
                                    <div class="modal fade" id="deleteConfirmationModal{{ $credit->id }}" tabindex="-1"
                                        aria-labelledby="deleteConfirmationModalLabel{{ $credit->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-dark"
                                                        id="deleteConfirmationModalLabel{{ $credit->id }}">Confirmer la
                                                        suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-dark">
                                                    Êtes-vous sûr de vouloir supprimer cet credit ?
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row justify-content-end">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form
                                                                action="{{ route('approuve.credit.cancel', ['id' => $credit->id]) }}"
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
