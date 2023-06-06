@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card  text-dark" style="background-color: ">
                    <div class="card-header">
                        <h4>Modife une document</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate=""
                            action="{{ route('post.document.edit', ['id' => $document->id]) }}"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="designation">Designation</label>
                                <input id="designation" type="text" class="form-control " name="designation"
                                    value="{{ old('designation', $document->designation) }}" required autofocus>
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">type</label>
                                <select name="type" class="form-select" id="type">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            @if ($document->type_courrier_id == $type->id) selected @endif>{{ $type->libelle }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nature" class="form-label">Nature</label>
                                <select name="nature" class="form-control" id="mode">
                                    <option value="1" {{ $document->nature == '1' ? 'selected' : '' }}>Financiers
                                    </option>
                                    <option value="2" {{ $document->nature == '2' ? 'selected' : '' }}>Administratif
                                    </option>
                                    <option value="3" {{ $document->nature == '3' ? 'selected' : '' }}>Légal</option>
                                    <option value="4" {{ $document->nature == '4' ? 'selected' : '' }}>Technique
                                    </option>
                                    <option value="5" {{ $document->nature == '5' ? 'selected' : '' }}>Commercial
                                    </option>
                                    <option value="6" {{ $document->nature == '6' ? 'selected' : '' }}>Ressources
                                        humaines</option>
                                    <option value="7" {{ $document->nature == '7' ? 'selected' : '' }}>Logistique
                                    </option>
                                    <option value="8" {{ $document->nature == '8' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('nature')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="feuille">Feuille de document</label>
                                <div>
                                    <a href="{{ url('document/pdf/' . $document->feuille) }}" class="btn btn-primary mb-3"
                                        target="_blank"><i class="bi bi-file-earmark-pdf"></i></a>
                                </div>
                                <input id="feuille" type="file" class="form-control" name="feuille"
                                    value="{{ old('feuille') }}">
                                @error('feuille')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="align-items-center d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Edit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
