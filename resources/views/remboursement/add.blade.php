@extends('layout')

@section('content')
    <style>
        .error {
            color: red;
            font-size: 0.8rem;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un Remboursement</h5>

                        <form method="POST" class="needs-validation" novalidate=""
                            action="{{ route('post.remboursement.add') }}" enctype="multipart/form-data" autocomplete="true">
                            @csrf
                            <div class="mb-3">
                                <label for="designation" class="mb-2 text-muted">Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation">
                                @error('designation')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="credit_id" class="mb-2 text-muted">Crédit</label>
                                <select name="credit_id" class="form-select" id="credit-select">
                                    <option value="">....</option>
                                    @foreach ($credits as $credit)
                                        @if ($credit->approuve)
                                            <option value="{{ $credit->id }}"
                                                data-remaining-balance="{{ $credit->montant - $credit->remboursements()->sum('montant') }}"
                                                @if (old('credit_id') == $credit->id) selected @endif>
                                                {{ $credit->designation }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('credit_id')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 reste">
                                <label for="reste" class="mb-2 text-muted">Reste</label>
                                <div id="reste" class="fw-bold ms-2"></div>
                            </div>

                            <div class="mb-3">
                                <label for="montant" class="mb-2 text-muted">Montant</label>
                                <input type="number" name="montant" class="form-control" min="0" id="montant">
                                @error('montant')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date_remboursement" class="mb-2 text-muted">date
                                    remboursement</label>
                                <input type="date" name="date_remboursement" class="form-control"
                                    id="date_remboursement">
                                @error('date_remboursement')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="feuille" class="mb-2 text-muted">Feuille de
                                    Remboursement</label>
                                <input type="file" name="feuille" class="form-control" id="feuille"
                                    accept="application/pdf">
                                @error('feuille')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" id="button" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateRemainingBalance() {
            var creditSelect = document.getElementById("credit-select");
            var creditId = creditSelect.value;
            if (creditId == "") {
                // If no credit is selected, clear the remaining balance div
                document.getElementById("reste").textContent = "";
            } else {
                // Otherwise, make an AJAX request to the server to get the remaining balance
                fetch(`/remboursement/add/credits/${creditId}/reste`)
                    .then(response => response.text())
                    .then(data => {
                        // Remove the quotes from the remaining balance value
                        var remainingBalance = parseInt(data.replace(/['"]+/g, ''));
                        document.getElementById("reste").textContent = remainingBalance + ' dh';
                    })
                    .catch(error => console.error(error));
            }
        }

        function checkMontant() {
            var montantInput = document.getElementById("montant");
            var remainingBalance = parseInt(document.getElementById("reste").textContent);
            var montantValue = parseFloat(montantInput.value);

            if (montantValue > remainingBalance) {
                var button = document.getElementById("button");
                button.disabled = true;
                montantInput.style.borderColor = "red";
                montantInput.style.backgroundColor = "#FFC9C9"; // set background color to light red

                // Display error message if not already shown
                var errorMessage = montantInput.parentElement.querySelector(".error");
                if (!errorMessage) {
                    errorMessage = document.createElement("div");
                    errorMessage.className = "error";
                    errorMessage.textContent = "Le montant doit être inférieur ou égal au reste.";
                    montantInput.parentElement.appendChild(errorMessage);
                }
            } else {
                var button = document.getElementById("button");
                button.disabled = false;
                montantInput.style.borderColor = "";
                montantInput.style.backgroundColor = ""; // remove background color

                // Remove error message if it exists
                var errorMessage = montantInput.parentElement.querySelector(".error");
                if (errorMessage) {
                    errorMessage.remove();
                }
            }
        }

        var montantInput = document.getElementById("montant");
        montantInput.addEventListener("input", checkMontant);

        var creditSelect = document.getElementById("credit-select");
        creditSelect.addEventListener("change", updateRemainingBalance);
        var currentDate = new Date().toISOString().split("T")[0];
        document.getElementById("date_remboursement").value = currentDate;
    </script>
@endsection
