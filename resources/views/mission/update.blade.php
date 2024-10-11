@extends('layouts.dashboard_sans_sta')

@section('content')
<div class="mb-4 mt-4 ms-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary d-inline-flex align-items-center">
        <svg class="icon-32 me-2" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        Retour
    </a>
</div>
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Modifier une mission</h4>
        </div> <br>

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                    <use xlink:href="#exclamation-triangle-fill"></use>
                </svg>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                    <use xlink:href="#check-circle-fill"></use>
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('update-mission', $mission->id) }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="exerciceBudgetaire_id" class="form-label">Exercice budgetaire</label>
                        <select name="exerciceBudgetaire_id" id="exerciceBudgetaire_id" class="form-control form-select"
                            required>
                            <option>Sélectionnez l'exercice budgetaire</option>
                            @foreach ($exerciceBudgetaires as $exerciceBudgetaire)
                                <option value="{{ $exerciceBudgetaire->id }}" {{ $exerciceBudgetaire->id ? 'selected' : ''}}> {{ $exerciceBudgetaire->exerciceBudgetaire }}
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
                                <option value="{{ $organisateur->id }}" {{ $organisateur->id ? 'selected' : ''}}> {{ $organisateur->nomOrganisateur }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nomMission" class="form-label">Nom mission</label>
                        <input type="text" required class="form-control" name="nomMission"
                            value="{{ old('nomMission', $mission->nomMission ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="dateFinMission" class="form-label">Date fin mission</label>
                        <input required type="date" required class="form-control" name="dateFinMission"
                            value="{{ old('dateFinMission', $mission->dateFinMission ?? '')}}">
                    </div>
                </div>
               
            </div>

            <div class="row">
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
                            value="{{ old('dateDebutMission', $mission->dateDebutMission ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="personnel_id" class="form-label">Personnel</label>
                        <select id="personnel_id" name="personnel_id[]" class="form-control form-select mb-2">
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
                                @foreach($personnelsSelect as $personnel)
                                <tr>
                                    <td>{{ $personnel->nomPrenomsPersonnel ?? ''}}</td>
                                    <td>{{ $personnel->indice->code ?? 'Non défini' }}</td>
                                    <td>{{ $personnel->rang->nomRang ?? 'Non défini' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Supprimer</button>
                                        <input type="hidden" name="personnel_ids[]" value="{{ $personnel->id }}">
                                    </td>
                                </tr> 
                            @endforeach   
                            </tbody>
                        </table>

                    </div>
                </div>
               
            </div>

            <div class="row">
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

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="objetMission" class="form-label">Objet mission</label>
                        <textarea class="form-control" required rows="4" value="{{ old('objetMission') }}" name="objetMission">{{ old('objetMission', $mission->objetMission ?? '') }}</textarea>
                    </div>
                </div>
                
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

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
    @endsection
