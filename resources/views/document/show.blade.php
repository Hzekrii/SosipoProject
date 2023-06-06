@extends('layout')

@section('content')
    <div class="card mb-5">
        <div class="card-header pb-0">
            <h6>Liste des documents</h6>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive my-4">
                <table id="table-datatable" class="table  table-striped-columns table-hover light-mode-table"
                    style="font-size: 0.9em;">
                    @if (Auth::user()->role_id == '3')
                        <div class="d-flex justify-content-start ms-3 mt-3">
                            <a href="{{ route('document.add') }}" class="btn btn-success text-light"><i
                                    class="bi bi-plus-circle me-2"></i>Nouveau document</a>
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th>Designation</th>
                            <th>Nature</th>
                            <th>Type</th>
                            <th>Rédigé par</th>
                            <th>Feuille</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $document->designation }}</td>

                                <td>
                                    @if ($document->nature == '1')
                                        Financiers
                                    @elseif ($document->nature == '2')
                                        Administratif
                                    @elseif ($document->nature == '3')
                                        Légal
                                    @elseif ($document->nature == '4')
                                        Technique
                                    @elseif ($document->nature == '5')
                                        Commercial
                                    @elseif ($document->nature == '6')
                                        Ressources humaines
                                    @elseif ($document->nature == '7')
                                        Logistique
                                    @else
                                        Autre
                                    @endif
                                </td>
                                    <td>
                                        @foreach ($types as $type)
                                            @if ($type->id == $document->type_courrier_id)
                                                {{ $type->libelle }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $document->user->name }}</td>
                                    <td>
                                        <a href="{{ url('document/pdf/' . $document->feuille) }}" class="btn btn-primary"><i
                                                class="bi bi-file-earmark-pdf"></i></a>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('document.edit', ['id' => $document->id]) }}"
                                                class="btn btn-primary pe-2">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmationModal{{ $document->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <!-- Delete confirmation modal -->
                                            <div class="modal fade" id="deleteConfirmationModal{{ $document->id }}"
                                                tabindex="-1"
                                                aria-labelledby="deleteConfirmationModalLabel{{ $document->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark"
                                                                id="deleteConfirmationModalLabel{{ $document->id }}">
                                                                Confirmer
                                                                la suppression</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-dark">
                                                            Vous ne pouvez pas supprimer cette document.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row justify-content-end">
                                                                <div class="col-auto">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Annuler</button>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <form
                                                                        action="{{ route('document.delete', $document->id) }}"
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
