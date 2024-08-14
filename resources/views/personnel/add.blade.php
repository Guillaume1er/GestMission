@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Ajouter un personnel</h4>
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

        <form method="POST" action="{{ route('create-personnel') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nomPrenomsPersonnel" class="form-label">Nom et Prénom</label>
                        <input type="text" required class="form-control" name="nomPrenomsPersonnel">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="numeroMatricule" class="form-label">Matricule</label>
                        <input type="text" required class="form-control" name="numeroMatricule">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="civilite" class="form-label">Civilité</label>
                        <input type="text" required class="form-control" name="civilite">
                    </div>
                </div>

            </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="tel" required class="form-control" name="contact">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" required class="form-control" name="email">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" required class="form-control" name="adresse">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="numIfu" class="form-label">Numéro Ifu</label>
                <input type="text"  class="form-control" name="numIfu">
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
                        <option value="{{ $rang->id }}">{{ $rang->nomRang }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="indice_id" class="form-label">Indice</label>
                <select class="form-select" required name="indice_id" id="indice_id">
                    <option selected>Sélectionner un indice</option>
                    @foreach ($indices as $indice)
                        <option value="{{ $indice->id }}">{{ $indice->code }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="text-end">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
        </form>

    </div>

    </div>
@endsection
