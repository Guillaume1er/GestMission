@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Formulaire de Validation</h4>
        </div>

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

        <form action="{{ route('validateMission', $detailMission->id) }}" method="POST">
            @csrf

            <!-- Nom du Personnel affiché automatiquement -->
            <div>
                <label for="nom_personnel">Nom du Personnel :</label>
                <input type="text" name="nom_personnel" id="nom_personnel" value="{{ $detailMission->personnel->nomPrenomsPersonnel }}" readonly>
            </div>

            <div>
                <label for="ref_om">Ref OM :</label>
                <input type="text" name="ref_om" id="ref_om" required>
            </div>

            <div>
                <label for="date_debut">Date de début :</label>
                <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $detailMission->dateDepart) }}" required>
            </div>

            <div>
                <label for="date_fin">Date de fin :</label>
                <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $detailMission->dateRetour) }}" required>
            </div>

            <div>
                <label for="moyen_deplacement">Moyen de déplacement :</label>
                <select name="moyen_deplacement" id="moyen_deplacement" required>
                    <option value="moyen_prive" {{ old('moyen_deplacement', $detailMission->moyen_deplacement) === 'moyen_prive' ? 'selected' : '' }}>Moyen privé</option>
                    <option value="moyen_entreprise" {{ old('moyen_deplacement', $detailMission->moyen_deplacement) === 'moyen_entreprise' ? 'selected' : '' }}>Moyen de l'entreprise</option>
                </select>
            </div>

            <div id="vehicule_select" style="{{ old('moyen_deplacement', $detailMission->moyen_deplacement) === 'moyen_entreprise' ? 'display:block;' : 'display:none;' }}">
                <label for="vehicule_id">Sélectionnez un véhicule :</label>
                <select name="vehicule_id" id="vehicule_id">
                    @foreach($vehicules as $vehicule)
                        <option value="{{ $vehicule->id }}" {{ old('vehicule_id', $detailMission->vehicule_id) == $vehicule->id ? 'selected' : '' }}>{{ $vehicule->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Valider</button>
        </form>
    </div>

    <script>
        document.getElementById('moyen_deplacement').addEventListener('change', function () {
            const vehiculeSelect = document.getElementById('vehicule_select');
            vehiculeSelect.style.display = this.value === 'moyen_entreprise' ? 'block' : 'none';
        });
    </script>
@endsection
