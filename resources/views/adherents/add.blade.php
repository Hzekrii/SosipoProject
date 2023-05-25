@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un adhérent</h5>
                        <form method="POST" class="needs-validation" novalidate="" action="{{ route('adherents.store') }}"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="matricule">Matricule</label>
                                <input id="matricule" type="text" class="form-control" name="matricule"
                                    value="{{ old('matricule') }}" required autofocus>
                                @error('matricule')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="name">Nom</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="prenom">Prénom</label>
                                <input id="prenom" type="text" class="form-control" name="prenom"
                                    value="{{ old('prenom') }}" required>
                                @error('prenom')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="cin">CIN</label>
                                <input id="cin" type="text" class="form-control" name="cin"
                                    value="{{ old('cin') }}" required>
                                @error('cin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">

                                <label for="categorie_id" class="form-label">Catégorie</label>
                                <div class="input-group">
                                    <select name="categorie_id" class="form-select" id="categorie_id">
                                        <option value="">...</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">
                                                {{ $categorie->libelle }}

                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary ms-2 " data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal"><i class="fas fa-plus-circle"></i></button>
                                    <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal"
                                        data-bs-target="#allCategoriesModal"><i class="fas fa-list"></i></button>

                                </div>

                                @error('categorie_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="nb_enfant">Nombre d'enfants</label>
                                <input id="nb_enfant" type="number" min="0" class="form-control" name="nb_enfant"
                                    value="{{ old('nb_enfant') }}" required>
                                @error('nb_enfant')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="situation_matrimoniale" class="form-label">Situation matrimoniale</label>
                                    <select class="form-select" id="situation_maritale" name="situation_maritale">
                                        <option value="">Sélectionnez une option</option>
                                        <option value="1">Marié(e)</option>
                                        <option value="2">Célibataire</option>
                                        <option value="3">Divorcé(e)</option>
                                        <option value="4">Veuf(ve)</option>
                                    </select>
                                </div>
                                @error('situation_maritale')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="align-items-center d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Ajouter
                                </button>
                            </div>
                        </form>
                        {{-- liste modal --}}
                        <div class="modal fade" id="allCategoriesModal" tabindex="-1"
                            aria-labelledby="allCategoriesModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="allCategoriesModalLabel">All Categories</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Libelle</th>
                                                </tr>
                                            </thead>
                                            <tbody id="categories-table-body">
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $category->id }}</td>
                                                        <td>
                                                            <form id="editCategoryForm"
                                                                action="{{ route('categories.update', ['category' => $category]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control me-3"
                                                                        id="edit-category-libelle"
                                                                        value="{{ $category->libelle }}" name="libelle">
                                                                    <button type="submit" id="update-category-btn"
                                                                        class="btn btn-primary btn-sm">Update</button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Add Category Modal -->
                        <div class="modal fade" id="addCategoryModal" tabindex="-1"
                            aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('categories.store') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="libelle">Libelle:</label>
                                                <input type="text" class="form-control" id="libelle" name="libelle"
                                                    required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
