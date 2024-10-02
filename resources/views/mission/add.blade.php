@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Ajouter une mission</h4>
        </div> <br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('create-mission') }}">
            @csrf
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exerciceBudgetaire_id" class="form-label">Exercice budgetaire</label>
                        <select name="exerciceBudgetaire_id" id="exerciceBudgetaire_id" class="form-control form-select"
                            required>
                            <option>Sélectionnez l'exercice budgetaire</option>
                            @foreach ($exerciceBudgetaires as $exerciceBudgetaire)
                                <option value="{{ $exerciceBudgetaire->id }}"> {{ $exerciceBudgetaire->exerciceBudgetaire }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="organisateur_id" class="form-label">Organisateur</label>
                        <select name="organisateur_id" id="organisateur_id" class="form-control form-select" required>
                            <option>Sélectionnez l'organisateur</option>
                            @foreach ($organisateurs as $organisateur)
                                <option value="{{ $organisateur->id }}"> {{ $organisateur->nomOrganisateur }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nomMission" class="form-label">Nom mission</label>
                        <input type="text" required class="form-control" name="nomMission"
                            value="{{ old('nomMission') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="observationMission" class="form-label">Observation mission</label>
                        <input type="text" class="form-control" name="observationMission"
                            value="{{ old('observationMission') }}" />
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6" hidden>
                    <div class="mb-3">
                        <label for="dateMission" class="form-label">Date mission</label>
                        <input type="text" required class="form-control" name="dateMission" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateDebutMission" class="form-label">Date début mission</label>
                        <input required type="date" class="form-control" name="dateDebutMission"
                            value="{{ old('dateDebutMission') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateFinMission" class="form-label">Date fin mission</label>
                        <input required type="date" required class="form-control" name="dateFinMission"
                            value="{{ old('dateFinMission') }}">
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="imputation" class="form-label">Imputation</label>
                        <select class="form-control form-select" required name="imputation" id="imputation">
                            <option>Sélectionner une imputation</option>
                            <option value="imputation 1">imputation 1</option>
                            <option value="imputation 2">imputation 2</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="previsionBBudgetaire" class="form-label">Prévision Budgetaire</label>
                        <select class="form-control form-select" required name="previsionBBudgetaire"
                            id="previsionBBudgetaire">
                            <option>Sélectionner une prévision budgetaire</option>
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="autorisateur1" class="form-label">Autorisateur 1</label>
                        <input type="text" class="form-control" name="autorisateur1"
                            value="{{ old('autorisateur1') }}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="autorisateur2" class="form-label">Autorisateur 2</label>
                        <input required type="text" class="form-control" name="autorisateur2"
                            value="{{ old('autorisateur2') }}" />
                    </div>
                </div>
            </div> --}}
            <div class="row mb-4">
                {{-- <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="autorisateur3" class="form-label">Autorisateur 3</label>
                        <input required type="text" class="form-control" name="autorisateur3"
                            value="{{ old('autorisateur3') }}" />
                    </div>
                </div> --}}
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="objetMission" class="form-label">Objet mission</label>
                        <textarea class="form-control" required rows="6" value="{{ old('objetMission') }}" name="objetMission"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="personnel_id" class="form-label">Personnel</label>
                        <select id="personnel_id" name="personnel_id[]" required class="form-control form-select mb-2">
                            <option value="">Sélectionner un personnel</option>
                            @foreach ($personnels as $personnel)
                                <option value="{{ $personnel->id }}"
                                    data-rang="{{ $personnel->rang->nomRang ?? 'Non défini' }}"
                                    data-indice="{{ $personnel->indice->code ?? 'Non défini' }}">
                                    {{ $personnel->nomPrenomsPersonnel }}
                                </option>
                            @endforeach
                        </select>

                        <table class="table table-bordered table-sm" id="personnelTable"
                            style="font-size: 0.8rem; max-width: 600px; margin: 0 auto;">
                            <thead>
                                <tr>
                                    <th style="width: 40%; padding: 0.2rem;">Nom et Prénom</th>
                                    <th style="width: 20%; padding: 0.2rem;">Indice</th>
                                    <th style="width: 20%; padding: 0.2rem;">Rang</th>
                                    <th style="width: 20%; padding: 0.2rem;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-6" hidden>
                    <div class="mb-3">
                        <label for="etatMission" class="form-label">Etat mission</label>
                        <select class="form-select" required name="etatMission" id="etatMission">
                            <option>Sélectionner l'état de la mission</option>
                            <option value="non démarrer" selected>Non démarré</option>
                            <option value="valider">Validé</option>
                            <option value="cloturer">Cloturé</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nbrVehicule" class="form-label">Nombre véhicule</label>
                        <input type="number" class="form-control" name="nbrVehicule"
                            value="{{ old('nbrVehicule') }}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="typeMission" class="form-label">Type mission</label>
                        <select class="form-select" required name="typeMission" id="typeMission">
                            <option>Sélectionner le type de mission</option>
                            <option value="interne">Mission interne</option>
                            <option value="externe">Mission externe</option>
                        </select>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nbrTotalNuite" class="form-label">Nombre total nuité</label>
                        <input type="number" class="form-control" name="nbrTotalNuite"
                            value="{{ old('nbrTotalNuite') }}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nbrTotalRepas" class="form-label">Nombre total repas</label>
                        <input type="number" class="form-control" name="nbrTotalRepas"
                            value="{{ old('nbrTotalRepas') }}" />
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="montantTotalNuite" class="form-label">Montant total nuité</label>
                        <input type="number" class="form-control" name="montantTotalNuite"
                            value="{{ old('montantTotalNuite') }}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="montantTotalRepas" class="form-label">Montant total repas</label>
                        <input type="number" class="form-control" name="montantTotalRepas"
                            value="{{ old('montantTotalRepas') }}" />
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="montantTotalMission" class="form-label">Montant total mission</label>
                        <input type="number" class="form-control" name="montantTotalMission"
                            value="{{ old('montantTotalMission') }}" />
                    </div>
                </div>               
            </div> --}}

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const personnelSelect = document.getElementById('personnel_id');
            const personnelTableBody = document.querySelector('#personnelTable tbody');

            personnelSelect.addEventListener('change', function() {
                const selectedOptions = Array.from(this.selectedOptions);

                selectedOptions.forEach(option => {
                    const nomPrenoms = option.textContent;
                    const indice = option.getAttribute('data-indice');
                    const rang = option.getAttribute('data-rang');
                    const personnelId = option.value;


                    const existingRow = Array.from(personnelTableBody.querySelectorAll('tr')).find(
                        row => {
                            return row.querySelector('input[type="hidden"]').value ===
                                personnelId;
                        });

                    if (!existingRow) {

                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${nomPrenoms}</td>
                    <td>${indice}</td>
                    <td>${rang}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Supprimer</button>
                        <input type="hidden" name="personnel_ids[]" value="${personnelId}">
                    </td>
                `;
                        personnelTableBody.appendChild(row);
                    }
                });
            });

            // Fonction pour supprimer une ligne du tableau
            window.removeRow = function(button) {
                button.closest('tr').remove();
            };
        });
    </script>

    </div>
@endsection
