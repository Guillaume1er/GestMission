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
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h2>Itinéraire pour le véhicule : <strong>{{ $plaqueVehicule }}</strong></h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label"><strong>Mission :</strong></label>
                        <p class="form-control-plaintext">{{ $mission->nomMission }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Lieu de mission :</strong></label>
                        <p class="form-control-plaintext">{{ $lieuMission->commune }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Distance :</strong></label>
                        <p class="form-control-plaintext">{{ $distance }} km</p>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-secondary mt-3" id="addRowBtn">Ajouter une ligne</button>
                    </div>
                </div>

                <form action="{{ route('mission.itineraire.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                    <input type="hidden" name="lieuMission_id" value="{{ $lieuMission->id }}">
                    <input type="hidden" name="vehicule_id" value="{{ $vehicule->id }}">


                    <table class="table" id="itineraireTable">


                        <thead>
                            <tr>
                                <th>Départ</th>
                                <th>Arrivée</th>
                                <th>Aller-Retour</th>
                                <th>Distance en km</th>
                                <th>Distance totale en km</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="depart[]" placeholder=""
                                        style="width: 150px;">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="arrive[]" placeholder=""
                                        style="width: 150px;">
                                </td>
                                <td>
                                    <input type="checkbox" name="allerRetour[]" value="1"
                                        onchange="calculateTotal(this)">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="distance_Km[]" placeholder=""
                                        style="width: 100px;" oninput="calculateTotal(this)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="distance_total_km[]" placeholder=""
                                        style="width: 100px;" readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn btn-primary mt-3">Enregistrer l'itinéraire</button>

                </form>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Distance Véhicule:</label>
                    <p class="form-control-plaintext distanceVehiculeMission">0 km</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Volume:</label>
                    <p class="form-control-plaintext volumeCarburant">0 L</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label">cout carburant unité:</label>
                    <p class="form-control-plaintext">{{ $systeme->prix_essence_litre }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Montant carburant:</label>
                    <p class="form-control-plaintext montantCarburant">0 FCFA</p>
                </div>
            </div>

        </div>

    </div>

    <script>
        document.getElementById('addRowBtn').addEventListener('click', function() {
            const tableBody = document.querySelector('#itineraireTable tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <input type="text" class="form-control" name="depart[]" placeholder="" style="width: 150px;">
                </td>
                <td>
                    <input type="text" class="form-control" name="arrive[]" placeholder="" style="width: 150px;">
                </td>
                <td>
                    <input type="checkbox" name="allerRetour[]" value="1" onchange="calculateTotal(this)">
                </td>
                <td>
                    <input type="number" class="form-control" name="distance_Km[]" placeholder="" style="width: 100px;" oninput="calculateTotal(this)">
                </td>
                <td>
                    <input type="text" class="form-control" name="distance_total_km[]" placeholder="" style="width: 100px;" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;

            tableBody.appendChild(newRow);
        });
       
        function calculateTotal(element) {
            const row = element.closest('tr');
            const distanceInput = row.querySelector('input[name="distance_Km[]"]');
            const totalInput = row.querySelector('input[name="distance_total_km[]"]');
            const allerRetourCheckbox = row.querySelector('input[name="allerRetour[]"]');

            const distance = parseFloat(distanceInput.value) || 0;
            const isAllerRetour = allerRetourCheckbox.checked;

            const totalDistance = isAllerRetour ? distance * 2 : distance;
            totalInput.value = totalDistance;
            const distanceInputs = document.querySelectorAll('input[name="distance_total_km[]"]');
            let total = 0;

            distanceInputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });

            document.querySelector('.distanceVehiculeMission').textContent = total + ' km';
            
          // Récupérer la consommation du véhicule
           consommationVehicule = {{ $systeme->consommation_vehicule_km }};
           prixEssenceLitre = {{ $systeme->prix_essence_litre }}; 
        
           // Calculer le volume d'essence consommé
            const volumeCarburant = total * consommationVehicule;

           // Afficher le volume d'essence dans l'interface
           document.querySelector('.form-control-plaintext.volumeCarburant').textContent = volumeCarburant.toFixed(2) + ' L';


           
         // Calcul du montant total du carburant
        const montantCarburant = volumeCarburant * prixEssenceLitre;
        document.querySelector('.form-control-plaintext.montantCarburant').textContent = montantCarburant.toFixed(2) + ' FCFA';
    }
        

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
        }

        function updateTotalDistance() {

        }
    </script>

    <!-- Assurez-vous d'inclure Font Awesome dans votre projet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
