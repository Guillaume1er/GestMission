@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Ajouter un organisateur</h4>
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

        <form method="POST" action="{{ route('create-organisateur') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nomOrganisateur" class="form-label">Nom & prénoms de l'organisateur</label>
                        <input type="text" required class="form-control" placeholder="SAGBO Jean" name="nomOrganisateur" value="{{ old('nomOrganisateur') }}">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>

    </div>

    </div>
@endsection
