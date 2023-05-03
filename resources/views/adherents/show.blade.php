@extends('layout')

@section('content')
<style>

    .container {
  padding: 20px;
}

.card {
  border-radius: 10px;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.card-header {
  border-radius: 10px 10px 0 0;
}

.card-body {
  border-top: 1px solid #dee2e6;
}

.card-footer {
  border-radius: 0 0 10px 10px;
  border-top: 1px solid #dee2e6;
}

.card-title {
  font-size: 2rem;
  font-weight: bold;
}

.form-label {
  font-weight: bold;
}

.form-text {
  color: #6c757d;
  font-size: 1.1rem;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0062cc;
  border-color: #005cbf;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
}

.btn-danger:hover {
  background-color: #c82333;
  border-color: #bd2130;
}

@media (min-width: 992px) {
  .card {
    max-width: 600px;
    margin: 0 auto;
  }
}

</style>
<div class="container mt-4">
  <div class="row">
    <div class="col-lg-6 mx-auto">
      <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white py-3">
          <h5 class="card-title mb-0">{{ $adherent->name }} {{ $adherent->prenom }}</h5>
          <p class="card-text">{{ $adherent->categorie->libelle }}</p>
        </div>
        <div class="card-body py-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label fw-bold mb-0">Matricule</label>
                <p class="form-text">{{ $adherent->matricule }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold mb-0">Nom</label>
                <p class="form-text">{{ $adherent->name }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold mb-0">Prénom</label>
                <p class="form-text">{{ $adherent->prenom }}</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label fw-bold mb-0">CIN</label>
                <p class="form-text">{{ $adherent->cin }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold mb-0">Nombre d'enfants</label>
                <p class="form-text">{{ $adherent->nb_enfant }}</p>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold mb-0">Situation maritale</label>
                <p class="form-text">
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
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white border-top-0">
          <div class="d-flex justify-content-end">
            <a href="{{ route('adherents.edit', $adherent) }}" class="btn btn-primary me-3">
              <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
              data-bs-target="#deleteAdherentModal">
              <i class="fas fa-trash-alt me-1"></i>Supprimer
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Delete Adherent Modal -->
    <div class="modal fade" id="deleteAdherentModal" tabindex="-1" aria-labelledby="deleteAdherentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAdherentModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet adhérent ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('adherents.destroy', $adherent) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
