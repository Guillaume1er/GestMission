@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Valider la mission</h4>
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

        <form method="POST" action="{{ route("validation-store", $mission->id) }}">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        {{-- <label for="personnel_id" class="form-label">Personnel</label>
                        <select id="personnel_id" name="personnel_id[]" class="form-control form-select mb-2">
                            <option value="">Sélectionner un personnel</option>
                            @foreach ($personnels as $personnel)
                                <option value="{{ $personnel->id }}"
                                    data-rang="{{ $personnel->rang->nomRang ?? 'Non défini' }}"
                                    data-indice="{{ $personnel->indice->code ?? 'Non défini' }}">
                                    {{ $personnel->nomPrenomsPersonnel }}
                                </option>
                            @endforeach
                        </select> --}}

                        <table class="table table-bordered table-sm" id="personnelTable">
                            <thead>
                                <tr>
                                    <th style="width: 20%; padding: 0.2rem;">Nom et Prénoms</th>
                                    <th style="width: 10%; padding: 0.2rem;">Indice</th>
                                    <th style="width: 10%; padding: 0.2rem;">Rang</th>
                                    <th style="width: 15%; padding: 0.2rem;">Date départ</th>
                                    <th style="width: 15%; padding: 0.2rem;">Date retour</th>
                                    <th style="width: 60%; padding: 0.2rem;">Lieu mission</th>
                                    <th style="width: 15%; padding: 0.2rem;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personnelsSelect as $personnel)
                                    <tr>
                                        <td>{{ $personnel->nomPrenomsPersonnel ?? '' }}</td>
                                        <td>{{ $personnel->indice->code ?? 'Non défini' }}</td>
                                        <td>{{ $personnel->rang->nomRang ?? 'Non défini' }}</td>
                                        <td>
                                            <input type="date" required name="dateDepart[{{ $personnel->id }}]"
                                                class="form-control" value="{{ $personnel->dateDepart ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="date" required name="dateRetour[{{ $personnel->id }}]" class="form-control"
                                                value="{{ $personnel->dateRetour ?? '' }}">
                                        </td>
                                        <td>
                                            <select required name="lieuMission_id[${personnelId}]" class="form-control form-select">
                                                <option value="">Sélectionner un lieu</option>
                                                @foreach ($lieux_mission as $lieu)
                                                    <option value="{{ $lieu->id }}">{{ $lieu->commune }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="removeRow(this)">Supprimer</button>
                                            <input type="hidden" name="personnel_ids[]" value="{{ $personnel->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Valider la mission</button>
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
                                    <input type="date" required name="dateDepart[${personnelId}]" class="form-control">
                                </td>
                                <td>
                                    <input type="date" required name="dateRetour[${personnelId}]" class="form-control">
                                </td>
                                <td>
                                    <select required name="lieuMission_id[${personnelId}]" class="form-control form-select">
                                        <option value="">Sélectionner un lieu</option>
                                        @foreach ($lieux_mission as $lieu)
                                            <option value="{{ $lieu->id }}">{{ $lieu->commune }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Supprimer</button>
                                    <input type="hidden" name="personnel_ids[]" value="${personnelId}">
                                </td>
                            `;
                            personnelTableBody.appendChild(row);
                        }
                    });
                });

                window.removeRow = function(button) {
                    button.closest('tr').remove();
                };
            });
        </script>
        {{-- <script>
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
        </script> --}}
    @endsection
