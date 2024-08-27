@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Modifier un personnel</h4>
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

        <form method="POST" action="{{ route('update-personnel', $personnel->id) }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nomPrenomsPersonnel" class="form-label">Nom et Prénom</label>
                        <input type="text" required class="form-control" name="nomPrenomsPersonnel"
                            value="{{ old('nomPrenomsPersonnel', $personnel->nomPrenomsPersonnel ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="numeroMatricule" class="form-label">Matricule</label>
                        <input type="text" required class="form-control" name="numeroMatricule"
                            value="{{ old('numeroMatricule', $personnel->numeroMatricule ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="civilite" class="form-label">Civilité</label>
                        <select name="civilite" class="form-control form-select" required>
                            <option value="">Sélectionnez la civilité</option>
                            <option value="M." {{ old('civilite', $personnel->civilite) == 'M.' ? 'selected' : '' }}>M.</option>
                            <option value="Mme" {{ old('civilite', $personnel->civilite) == 'Mme' ? 'selected' : '' }}>Mme</option>
                            {{-- <option value="Mlle" {{ old('civilite', $personnel->civilite) == 'Mlle' ? 'selected' : '' }}>Mlle</option> --}}
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="tel" required class="form-control" name="contact"
                            value="{{ old('contact', $personnel->contact ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" required class="form-control" name="email"
                            value="{{ old('email', $personnel->email ?? '') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" required class="form-control" name="adresse"
                            value="{{ old('adresse', $personnel->adresse ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="rang_id" class="form-label">Rang</label>
                        <select class="form-select" required name="rang_id" id="rang_id">
                            <option selected>Sélectionner un indice</option>
                            @foreach ($rangs as $rang)
                                <option value="{{ $rang->id }}" {{ old('rang_id', $personnel->rang_id ?? '') == $rang->id ? 'selected' : '' }}>
                                    {{ $rang->nomRang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="indice_id" class="form-label">Indice</label>
                        <select class="form-select" required name="indice_id" id="indice_id">
                            <option selected>Sélectionner un indice</option>
                            @foreach ($indices as $indice)
                                <option value="{{ $indice->id }}" {{ $indice->id ? 'selected' : '' }}>
                                    {{ $indice->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="numIfu" class="form-label">Numéro Ifu</label>
                        <input type="text" class="form-control" name="numIfu"
                            value="{{ old('numIfu', $personnel->numIfu ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>



    @endsection
