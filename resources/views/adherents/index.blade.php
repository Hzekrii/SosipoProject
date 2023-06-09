@extends('layout')

@section('content')
    <div class="card mb-5">
        <div class="card-header pb-0">
            <h5 class="card-title">Liste des adhérents</h5>
        </div>
        <div class="card-body px-4 pt-0 pb-2">
            <div class="table-responsive my-4">

                <table id="table-datatable" class="table rounded  table-striped-columns table-hover  light-mode-table"
                    style="width:100%">
                    @if (Auth::user()->role_id != '3')
                        <div class="d-flex justify-content-start ms-3 mt-3">
                            <a href="{{ route('adherents.create') }}" class="btn btn-success text-light"><i
                                    class="bi bi-plus-circle me-2"></i>Nouveau adherents</a>
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>CIN</th>
                            <th>Catégorie</th>
                            <th>Nombre d'enfants</th>
                            <th>Situation maritale</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adherents as $adherent)
                            <tr>
                                <td>{{ $adherent->matricule }}</td>
                                <td>{{ $adherent->name }}</td>
                                <td>{{ $adherent->prenom }}</td>
                                <td>{{ $adherent->cin }}</td>
                                <td>{{ $adherent->categorie ? $adherent->categorie->libelle : '-' }}</td>
                                <td>{{ $adherent->nb_enfant }}</td>
                                <td>
                                    @switch($adherent->situation_maritale)
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
                                            -
                                    @endswitch
                                </td>

                                <td>
                                    <a href="{{ route('adherents.show', $adherent) }}" class="btn btn-sm btn-primary"
                                        title="Afficher">
                                        <i class="bi bi-eye bi-3x"></i>
                                    </a>
                                    <a href="{{ route('adherents.edit', $adherent) }}" class="btn btn-sm btn-warning"
                                        title="Modifier">
                                        <i class="bi bi-pencil bi-3x"></i>
                                    </a>
                                    <form action="{{ route('adherents.destroy', $adherent) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr ?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                            <i class="bi bi-trash bi-3x"></i>
                                        </button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
