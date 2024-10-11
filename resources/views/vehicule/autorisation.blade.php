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
            @if ($vehicule->autorisationSortie)
                <h4 class="card-title">Désautorisation de sortie pour le véhicule {{ $vehicule->plaqueVehicule }}</h4>
            @else
                <h4 class="card-title">Autorisation de sortie pour le véhicule {{ $vehicule->plaqueVehicule }}</h4>
            @endif
        </div> <br> <br>

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

        @if ($vehicule->autorisationSortie)
            <div class="container">
                {{-- <h1>Autorisation de sortie pour le véhicule {{ $vehicule->plaqueVehicule }}</h1> --}}

                <form action="{{ route('vehicule.desautoriser', $vehicule->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="motifDesautorisation" class="form-label">Motif de désautorisation</label>
                            <textarea class="form-control" id="motifDesautorisation" rows="4" name="motifDesautorisation" required></textarea>
                        </div>
                        <div class="mt-1 col-lg-6">
                            <label for="dateDesautorisation" class="form-label">Date de la désautorisation</label>
                            <input type="date" class="form-control" id="dateDesautorisation" name="dateDesautorisation"
                                 value="{{ now()->format('Y-m-d') }}" readonly style="background-color: #e9ecef;">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger">Désautoriser</button>
                    </div>
                </form>
            </div>
        @else
            <div class="container">
                {{-- <h1>Autorisation de sortie pour le véhicule {{ $vehicule->plaqueVehicule }}</h1> --}}

                <form action="{{ route('vehicule.autoriser', $vehicule->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="kilometrageDepart" class="form-label">Kilométrage de départ</label>
                            <input type="number" class="form-control" id="kilometrageDepart" name="kilometrageDepart"
                                required>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="dateAutorisation" class="form-label">Date d'autorisation</label>
                            <input type="date" class="form-control" id="dateAutorisation" name="dateAutorisation"
                            value="{{ now()->format('Y-m-d') }}" readonly style="background-color: #e9ecef;">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Autoriser</button>
                    </div>
                </form>
            </div>
        @endif




    </div>


@endsection
