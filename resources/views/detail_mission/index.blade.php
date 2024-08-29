@extends('layouts/dashboard_sans_sta')

@section('content')

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Détail de la mission <span
                        class="bg-info p-2 text-white">{{ $mission->mission->nomMission }}</span> </h4>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-2 d-flex align-items-center" role="alert">
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
            <div class="alert alert-success mt-2 d-flex align-items-center" role="alert">
                <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                    <use xlink:href="#check-circle-fill"></use>
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif


        <div class="table-responsive border-bottom my-3">

            <div class="row">
                <div class="col-lg-12">
                    <style>
                        div {
                            margin-bottom: 10px;
                        }

                        .label_header {
                            display: inline-block;
                            width: 160px;
                        }
                    </style>
                    <div class="container">
                        <fieldset style="background:#e1eff2;" class="p-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <legend class="text-black" style="font-size:24px;">Informations sur la mission</legend>
                                    <div>
                                        <label class="label_header">Numéro mission:</label>
                                        <input type="text" disabled value="{{ $mission->mission->refMission }}">
                                    </div>
                                    <div>
                                        <label class="label_header">Réf mission:</label>
                                        <input type="number" disabled value="{{ $mission->mission->numMission }}">
                                    </div>
                                    <div>
                                        <label class="label_header">Exercice budgetaire:</label>
                                        <input disabled type="number"
                                            value="{{ $mission->mission->exerciceBudgetaire->exerciceBudgetaire }}">
                                    </div>
                                    <div>
                                        <label class="label_header">Date début mission:</label>
                                        <input disabled type="date" value="{{ $mission->mission->dateDebutMission }}">
                                    </div>
    
                                    <div>
                                        <label class="label_header">Date fin mission:</label>
                                        <input disabled type="date" value="{{ $mission->mission->dateFinMission }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <legend class="text-black" style="font-size:24px;">Informations sur le personnel</legend>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr style="border: 2px solid">
                                                <th>Nom et Prénoms</th>
                                                <th>Indice</th>
                                                <th>Rang</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($personnels as $personnal_mission)
                                                <tr style="border: 1px solid">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <h6>{{ $personnal_mission->nomPrenomsPersonnel }}</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="iq-media-group iq-media-group-1">
                                                            <a class="iq-media-1">
                                                                <div class="">{{ $personnal_mission->indice->code }}
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-info">{{ $personnal_mission->rang->nomRang }}</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br> <br>
    
                            <form method="POST" action="{{ route('create-detail-mission') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="dateDepart">Date départ</label>
                                        <input type="date" class="form-control" name="dateDepart" value="{{ $mission->mission->dateDebutMission }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="dateRetour">Date retour</label>
                                        <input type="date" class="form-control" id="dateRetour" name="dateRetour" value="{{ $mission->mission->dateFinMission }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="nbrJour">Nombre de jour</label>
                                        <input type="number" class="form-control" id="nbrJour" name="nbrJour">
                                            
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="nbrNuit">Nombre de nuit</label>
                                        <input type="number" class="form-control" id="nbrNuit" name="nbrNuit">
                                            
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="coutNuite">Coût nuité</label>
                                        <input type="number" class="form-control" id="coutNuite" name="coutNuite" value="">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label" for="montantNuite">Montant nuité:</label>
                                        <input type="number" class="form-control" id="montantNuite" name="montantNuite" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="nbrRepas">Nombre repas</label>
                                        <input type="number" class="form-control" id="nbrRepas" name="nbrRepas">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="coutRepas">Coût repas</label>
                                        <input type="number" class="form-control" id="coutRepas" name="coutRepas">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="montantRepas">Montant repas</label>
                                        <input type="number" class="form-control" id="montantRepas" name="montantRepas">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="dateTraitementMission">Date de traitement de la mission</label>
                                        <input type="date" class="form-control" id="dateTraitementMission" name="dateTraitementMission">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="montantMission">Montant mission</label>
                                        <input type="number" class="form-control" id="montantMission" name="montantMission">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="montantAvance">Montant avance</label>
                                        <input type="number" class="form-control" id="montantAvance" name="montantAvance">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="montantReste">Montant restant</label>
                                        <input type="number" class="form-control" id="montantReste" name="montantReste">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="dateSignatureOm">Date signature Om</label>
                                        <input type="date" class="form-control" id="dateSignatureOm" name="dateSignatureOm">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="refOm">Référence Om</label>
                                        <input type="text" class="form-control" id="refOm" name="refOm">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="montantPaye">Montant payé</label>
                                        <input type="number" class="form-control" id="montantPaye" name="montantPaye">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="observation">Observation</label>
                                        <input type="text" class="form-control" id="observation" name="observation">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="dateDernierPayement">Date dernier paiement</label>
                                        <input type="date" class="form-control" id="dateDernierPayement" name="dateDernierPayement">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="payementJustifie">Justification de paiement</label>
                                        <input type="text" class="form-control" id="payementJustifie" name="payementJustifie">
                                    </div>
                                </div>
                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Valider la mission</button>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                    <div class="card-body text-right">
                        <div class="new-user-info">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
